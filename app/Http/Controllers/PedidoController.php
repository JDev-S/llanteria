<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Connection;
use App\Http\Controllers\BateriasController;
use DB;
class PedidoController extends Controller
{
    
    /*PEDIDOS A PROOVEDORES*/
    public function mostrar_pedidos_proveedor()
    {
        $pedidos_proveedores=DB::select("select pv.id_pedido,
                usuario.nombre_completo,
                s1.sucursal as sucursal_usuario,
                s2.sucursal as sucursal_pedido, 
                pv.descripcion, 
                pv.total_venta, 
                pv.fecha_venta
                FROM pedido_proveedor pv
                INNER JOIN sucursal s1 on s1.id_sucursal=pv.id_sucursal 
                INNER JOIN sucursal s2 on s2.id_sucursal=pv.id_sucursal_usuario
                INNER JOIN usuario on usuario.id_usuario=pv.id_usuario and pv.id_sucursal_usuario=s2.id_sucursal
                WHERE pv.id_pedido in (SELECT pedido_proveedor.id_pedido from pedido_proveedor);");
        
        $pedidos_detalles=DB::select("select detalle_pedido_proveedor.id_pedido_proveedor,
	                                  usuario.nombre_completo, 
                                      s2.sucursal as sucursal_usuario,
                                      s1.sucursal as sucursal_pedido,
                                      detalle_pedido_proveedor.total,
                                      detalle_pedido_proveedor.cantidad,
                                      detalle_pedido_proveedor.precio_unidad,
                                      productos_llantimax.nombre,
                                      proveedores.nombre_contacto
                                      FROM detalle_pedido_proveedor 
                                      INNER JOIN pedido_proveedor on pedido_proveedor.id_pedido=detalle_pedido_proveedor.id_pedido_proveedor and detalle_pedido_proveedor.id_usuario=pedido_proveedor.id_usuario and detalle_pedido_proveedor.id_usuario_sucursal=pedido_proveedor.id_sucursal_usuario and pedido_proveedor.id_sucursal=detalle_pedido_proveedor.id_sucursal 
                                      INNER JOIN catalogo on detalle_pedido_proveedor.id_producto=catalogo.id_producto and detalle_pedido_proveedor.id_catalogo=catalogo.id_catalogo 
                                      INNER JOIN productos_llantimax on productos_llantimax.id_productos_llantimax=catalogo.id_producto 
                                      INNER JOIN proveedores on proveedores.id_proveedor=catalogo.id_proveedor 
                                      INNER JOIN usuario on pedido_proveedor.id_usuario=usuario.id_usuario and pedido_proveedor.id_sucursal_usuario=usuario.id_sucursal
                                      INNER JOIN sucursal s1 on s1.id_sucursal=pedido_proveedor.id_sucursal
                                      INNER JOIN sucursal s2 on s2.id_sucursal=pedido_proveedor.id_sucursal_usuario
                                    ");
        /* print_r($pedidos_detalles);
         
          die();*/
       
        
        return view('/principal/pedidos/proveedores/index',compact('pedidos_proveedores','pedidos_detalles'));
                
    } 
    
    public function generar_pedido_proveedor(Request $input)
    {
        $id_usuario = session('id_usuario');//session
        $id_sucursal_usuario = session('id_sucursal_usuario');//session
        $id_sucursal =session('id_sucursal_usuario');
        $id_metodo_pago = $input ['id_metodo_pago'];
        $total_venta = $input ['total_venta'];
        $array_productos=$input['array_productos'];
       
       
        
        /*OBTENER FECHA ACTUAL*/ 
        $fecha_venta= PedidoController::obtener_fecha_actual();
       
        /*GENERAR FOLIO DE VENTA*/
        $id_pedido = PedidoController::generar_folio_proveedor($id_sucursal, $id_usuario."".$id_sucursal_usuario);
       
        /*INICIAR TRANSACCIÓN*/
       DB::beginTransaction();
        try{
            /*GENERAR VENTA*/
            $ingresar = DB::insert('INSERT INTO pedido_proveedor(id_pedido, id_usuario, id_sucursal_usuario, id_sucursal, descripcion, total_venta, fecha_venta) VALUES(?,?,?,?,?,?,?)', [$id_pedido, $id_usuario, $id_sucursal_usuario, $id_sucursal, '', $total_venta, $fecha_venta]);
            //INSERT INTO `pedido_proveedor`(`id_pedido`, `id_usuario`, `id_sucursal_usuario`, `id_sucursal`, `descripcion`, `total_venta`, `fecha_venta`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
       
            /*INSERTAR DETALLE DE LA VENTA*/
            foreach($array_productos as $propiedad){
                $ingresar = DB::insert('INSERT INTO detalle_pedido_proveedor (id_pedido_proveedor, id_usuario, id_usuario_sucursal, id_sucursal, id_producto, id_catalogo, total, cantidad, precio_unidad) VALUES (?,?,?,?,?,?,?,?,?)', [$id_pedido, $id_usuario, $id_sucursal_usuario, $id_sucursal, $propiedad['id_producto'],$propiedad['catalogo'], $propiedad['total'] , $propiedad['cantidad_producto'] , $propiedad['precio_unidad']]);
                //INSERT INTO `detalle_pedido_proveedor`(`id_pedido_proveedor`, `id_usuario`, `id_usuario_sucursal`, `id_sucursal`, `id_producto`, `id_catalogo`, `total`, `cantidad`, `precio_unidad`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])
            }
            echo 'Venta realizada';
            DB::commit();
        }catch (Exception $e){
                echo 'Ha ocurrido un error!';
                DB::rollback();
        }
    }
    
    function mostrar_catalogo_proveedores()
    {
        $catalogos=DB::select("select catalogo.id_producto, productos_llantimax.nombre, proveedores.id_proveedor, proveedores.nombre_contacto,proveedores.nombre_empresa, proveedores.id_sucursal, IFNULL(sucursal.sucursal, 'Global') as sucursal,catalogo.precio_compra,catalogo.id_catalogo from catalogo INNER JOIN proveedores on proveedores.id_proveedor=catalogo.id_proveedor LEFT JOIN sucursal on sucursal.id_sucursal=proveedores.id_sucursal INNER JOIN productos_llantimax on productos_llantimax.id_productos_llantimax=catalogo.id_producto");
        
        return view('/principal/pedidos/proveedores/agregar',compact('catalogos'));
    }
    
    
     /*MÉTODO PARA GENERAR FOLIO pedido proveedor*/
    function generar_folio_proveedor($id_sucursal, $id_usuario)
    {
        $id_venta = $id_usuario."".$id_usuario."".PedidoController::generar_cadena_aleatoria_proveedor();
        
        return $id_venta;
    }
    
    /*MÉTODO PARA OBTENER LA FECHA ACTUAL*/
    function obtener_fecha_actual()
    {
        $dia=date("d");
        $mes=date("m");
        $anio=date("Y");
        $fecha =$anio.'-'.$mes.'-'.$dia; 
        
        return $fecha;
    }
    
    /*MÉTODO PARA GENERAR UNA CADENA ALEATORIA para proovedor*/
    function generar_cadena_aleatoria_proveedor($longitud = 8) 
    {
        $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longitud_caracteres = strlen($caracteres_permitidos);
        $cadena_random = '';
        
        for($i = 0; $i < $longitud; $i++) {
            $caracter_random = $caracteres_permitidos[mt_rand(0, $longitud_caracteres - 1)];
            $cadena_random .= $caracter_random;
        }
        
        /*OBTENER EL NÚMERO DE REGISTROS ACTUAL DE VENTAS*/
        try{
            $query = DB::select('select count(*) as pedidos from pedido_proveedor');    
        } catch(Exception $e){
            echo 'Ha ocurrido un error!';
        }
        $ventas_actuales = $query[0]->pedidos;
        
        return $cadena_random."".($ventas_actuales+1);
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*PEDIDOS A SUCURSALES*/
    

    public function mostrar_pedidos_sucursales()
    {
        /*$pedidos_sucursales=DB::select('SELECT pedido.id_pedido,
	   usu_solicitante.id_usuario as id_usuario_solicitante,
       usu_solicitante.nombre_completo as nombre_solicitante ,
       suc_usu_solicitante.id_sucursal as id_sucursal_solicitante,
       suc_usu_solicitante.sucursal as sucursal_solicitante ,
       usu_distribuidor.id_usuario as id_usuario_distribuidor,
       usu_distribuidor.nombre_completo as nombre_distribuidor,
       suc_usu_distribuidor.id_sucursal as id_sucursal_distribuidor,
       suc_usu_distribuidor.sucursal as sucursal_distribuidor,
       suc_origen.id_sucursal as id_sucursal_origen,
       suc_origen.sucursal as sucursal_origen,
       suc_destino.id_sucursal as id_sucursal_destino,
       suc_destino.sucursal as sucursal_destino
       FROM pedido 
       INNER JOIN status on status.id_status=pedido.id_status 
       INNER JOIN sucursal suc_origen on suc_origen.id_sucursal=pedido.id_origen
       INNER JOIN sucursal suc_destino on suc_destino.id_sucursal=pedido.id_destino
       INNER JOIN usuario usu_solicitante on usu_solicitante.id_usuario=pedido.id_usuario_solicitante and usu_solicitante.id_sucursal=pedido.id_sucursal_destino
       INNER JOIN usuario usu_distribuidor on usu_distribuidor.id_usuario=pedido.id_usuario_distribuidor and usu_distribuidor.id_sucursal=pedido.id_sucursal_destino
       INNER JOIN sucursal suc_usu_solicitante on suc_usu_solicitante.id_sucursal=pedido.id_sucursal_destino AND pedido.id_usuario_solicitante=usu_solicitante.id_usuario
       INNER JOIN sucursal suc_usu_distribuidor on suc_usu_distribuidor.id_sucursal=pedido.id_sucursal_origen AND pedido.id_usuario_distribuidor=usu_solicitante.id_usuario');*/
      $pedidos_sucursales=DB::select('select pedido.id_pedido,
suc_destino.id_sucursal as id_sucursal_destino,
suc_destino.sucursal as sucursal_destino,
suc_origen.id_sucursal as id_sucursal_origen,suc_origen.sucursal as sucursal_origen,status.id_status,status.status,usu_origen.id_usuario as id_usuario_origen, usu_origen.nombre_completo as nombre_usuario_origen,usu_destino.id_usuario as id_usuario_destino,usu_destino.nombre_completo as nombre_usuario_destino,sucu_usu_destino.id_sucursal as id_sucursal_usuario_destino,sucu_usu_destino.sucursal as nombre_sucursal_usuario_destino, sucu_usu_origen.id_sucursal as id_sucursal_usuario_origen, sucu_usu_origen.sucursal as nombre_sucursal_usuario_origen  from pedido inner join status on status.id_status=pedido.id_status inner join sucursal suc_origen on suc_origen.id_sucursal=pedido.id_origen inner join sucursal suc_destino on suc_destino.id_sucursal=pedido.id_destino inner join usuario usu_origen on usu_origen.id_usuario=pedido.id_usuario_distribuidor and usu_origen.id_sucursal=pedido.id_sucursal_origen inner join usuario usu_destino on usu_destino.id_usuario=pedido.id_usuario_solicitante and usu_destino.id_sucursal=pedido.id_sucursal_destino inner join sucursal sucu_usu_destino on sucu_usu_destino.id_sucursal=usu_destino.id_sucursal Inner join sucursal sucu_usu_origen on sucu_usu_origen.id_sucursal=usu_origen.id_sucursal');
        
      $detalles_pedido_sucursal=DB::select('SELECT detalle_pedido.id_pedido, detalle_pedido.id_producto, productos_llantimax.nombre, detalle_pedido.cantidad, detalle_pedido.descripcion FROM detalle_pedido INNER JOIN productos_llantimax on productos_llantimax.id_productos_llantimax=detalle_pedido.id_producto');
        
    $historial_pedidos=DB::select('select * from historial_pedido inner join status on status.id_status=historial_pedido.id_status');
        
       return view('/principal/pedidos/sucursales/index',compact('pedidos_sucursales','detalles_pedido_sucursal','historial_pedidos'));
    }
    
    public function actualizar_status_pedido(Request $input)
    {
         $id_status = $input ['id_status'];
         $id_pedido=$input['id_pedido'];
         $comentario=$input['comentario'];
        $id_sucursal = session('id_sucursal_usuario');
         
        $dia=date("d");
        $mes=date("m");
        $anio=date("Y");
        $fecha_status =$anio.'-'.$mes.'-'.$dia; 
         //INSERT INTO `historial_pedido`(`id_pedido`, `id_status`, `fecha_evento`, `descripcion_evento`) VALUES ([value-1],[value-2],[value-3],[value-4])
            
        
               
        $actualizar = DB::update('UPDATE pedido SET id_status='.$id_status.' WHERE id_pedido=? ', [$id_pedido]);
        
        $cantidades_historial=DB::select('select * from historial_pedido where id_pedido="'.$id_pedido.'"');
        $bandera="0";
        foreach($cantidades_historial as $cantidad_historial)
        {
            if($cantidad_historial->id_status=="2")
            {
                $bandera="1";
            }
            
        }
        $ingresar = DB::insert('INSERT INTO historial_pedido(id_pedido, id_status, fecha_evento, descripcion_evento) VALUES (?,?,?,?)', [$id_pedido, $id_status, $fecha_status , $comentario]);
        
      echo"El valor de bandera es :".$bandera;
        
        if($bandera=="0")
        {
               if($id_status=="2")
            {
                $productos=DB::select('select * from detalle_pedido where id_pedido="'.$id_pedido.'"');
                foreach($productos as $producto)
                {
                    $cantidad_inventario = DB:: select("select cantidad  from inventario where id_producto='".$producto->id_producto."' and id_sucursal='".$id_sucursal."'");
                    
                    $cantidad=$cantidad_inventario[0]->cantidad;
                    $cantidad_final =intval($cantidad)- intval($producto->cantidad);
                    $actualizar = DB::update('UPDATE inventario SET cantidad='.$cantidad_final.' WHERE id_producto=? AND id_sucursal=?', [$producto->id_producto,$id_sucursal]);   
                } 
            }
        }
        else 
        {
            if($id_status=="3" && $bandera=="1")
            {
                 $productos=DB::select('select * from detalle_pedido where id_pedido="'.$id_pedido.'"');
                foreach($productos as $producto)
                {
                    $cantidad_inventario = DB:: select("select cantidad  from inventario where id_producto='".$producto->id_producto."' and id_sucursal='".$id_sucursal."'");
                    $cantidad=$cantidad_inventario[0]->cantidad;
                    $cantidad_final =intval($cantidad)+ intval($producto->cantidad);
                    $actualizar = DB::update('UPDATE inventario SET cantidad='.$cantidad_final.' WHERE id_producto=? AND id_sucursal=?', [$producto->id_producto,$id_sucursal]);   
                } 
            }
        }
        
         
    }
    
    public function mostrar_pedidos_solicitados()
    {
        $id_sucursal_usuario_destino = session('id_sucursal_usuario');
        $pedidos_solicitados=DB::select('select pedido.id_pedido,
        suc_destino.id_sucursal as id_sucursal_destino,
        suc_destino.sucursal as sucursal_destino,
        suc_origen.id_sucursal as id_sucursal_origen,suc_origen.sucursal as sucursal_origen,status.id_status,status.status,usu_origen.id_usuario as id_usuario_origen, usu_origen.nombre_completo as nombre_usuario_origen,usu_destino.id_usuario as id_usuario_destino,usu_destino.nombre_completo as nombre_usuario_destino,sucu_usu_destino.id_sucursal as id_sucursal_usuario_destino,sucu_usu_destino.sucursal as nombre_sucursal_usuario_destino, sucu_usu_origen.id_sucursal as id_sucursal_usuario_origen, sucu_usu_origen.sucursal as nombre_sucursal_usuario_origen  from pedido inner join status on status.id_status=pedido.id_status inner join sucursal suc_origen on suc_origen.id_sucursal=pedido.id_origen inner join sucursal suc_destino on suc_destino.id_sucursal=pedido.id_destino inner join usuario usu_origen on usu_origen.id_usuario=pedido.id_usuario_distribuidor and usu_origen.id_sucursal=pedido.id_sucursal_origen inner join usuario usu_destino on usu_destino.id_usuario=pedido.id_usuario_solicitante and usu_destino.id_sucursal=pedido.id_sucursal_destino inner join sucursal sucu_usu_destino on sucu_usu_destino.id_sucursal=usu_destino.id_sucursal Inner join sucursal sucu_usu_origen on sucu_usu_origen.id_sucursal=usu_origen.id_sucursal where suc_origen.id_sucursal='.$id_sucursal_usuario_destino);
        
        $detalles_pedido_sucursal=DB::select('SELECT detalle_pedido.id_pedido, detalle_pedido.id_producto, productos_llantimax.nombre, detalle_pedido.cantidad, detalle_pedido.descripcion FROM detalle_pedido INNER JOIN productos_llantimax on productos_llantimax.id_productos_llantimax=detalle_pedido.id_producto');
        
        return view('/principal/pedidos/sucursales/pedidos_solicitados',compact('pedidos_solicitados','detalles_pedido_sucursal'));
    }
    
    public function pedido_sucursal()
    {
        $pedido="";
        return view('/principal/pedidos/sucursales/agregar',compact('pedido'));
    }
    
    public function obtener_productos_sucursales(Request $input)
    {
        $id_sucursal=$input['id_sucursal'];
        $query=DB::select("select inventario.id_producto as id_producto, productos_llantimax.nombre as nombre_producto, categoria.categoria as categoria, marca.marca as marca, producto.modelo as modelo,productos_servicios.precio as precio, producto.fotografia_miniatura as foto, sucursal.sucursal as sucursal, inventario.cantidad as cantidad, sucursal.id_sucursal as id_sucursal from inventario inner join productos_llantimax on productos_llantimax.id_productos_llantimax=inventario.id_producto inner join sucursal on inventario.id_sucursal=sucursal.id_sucursal inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio inner join marca on marca.id_marca=producto.id_marca inner join categoria on categoria.id_categoria=producto.id_categoria where sucursal.id_sucursal='".$id_sucursal."'");
        $json=json_encode($query);
		return response()->json($json);
        
    }
    
    public function agregar_pedidos_sucursales(Request $input)
    {
          /*RECUPERAR DATOS PARA LA VENTA*/
        $id_usuario_destino = session('id_usuario');//session
        $id_sucursal_usuario_destino = session('id_sucursal_usuario');//session
        
        
        $array_productos=$input['array_productos'];
        $comentario=$input['descripcion'];
        $id_sucursal_origen=$input['id_sucursal'];
        $id_usuario_origen = PedidoController::obtener_usuario_origen($id_sucursal_origen);
                
        /*GENERAR FOLIO DE VENTA*/
        $id_venta = PedidoController::generar_folio($id_usuario_destino."".$id_sucursal_usuario_destino,$id_sucursal_origen."".$id_usuario_origen );
        $dia=date("d");
        $mes=date("m");
        $anio=date("Y");
        $fecha_venta =$anio.'-'.$mes.'-'.$dia; 
        
        /*INICIAR TRANSACCIÓN*/
       DB::beginTransaction();
        try{
            /*GENERAR VENTA*/
            $ingresar = DB::insert('INSERT INTO pedido(id_pedido, id_usuario_solicitante, id_status, descripcion, id_sucursal_origen, id_sucursal_destino, id_usuario_distribuidor, id_origen, id_destino) VALUES (?,?,?,?,?,?,?,?,?)', [$id_venta,$id_usuario_destino,1,$comentario,$id_sucursal_origen,$id_sucursal_usuario_destino,$id_usuario_origen,$id_sucursal_origen,$id_sucursal_usuario_destino]);
            //INSERT INTO `pedido`(`id_pedido`, `id_usuario_solicitante`, `id_status`, `descripcion`, `id_sucursal_origen`, `id_sucursal_destino`, `id_usuario_distribuidor`, `id_origen`, `id_destino`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])
       
            /*INSERTAR DETALLE DE LA VENTA*/
            foreach($array_productos as $propiedad){
                $ingresar = DB::insert('INSERT INTO detalle_pedido(id_pedido, id_producto, cantidad, descripcion) VALUES (?,?,?,?)', [$id_venta, $propiedad['id_producto'], $propiedad['cantidad_producto'] , $comentario]);
                //INSERT INTO `detalle_pedido`(`id_pedido`, `id_producto`, `cantidad`, `descripcion`) VALUES ([value-1],[value-2],[value-3],[value-4])
                
                
                /*VERIFICAR SI SE TRATA DE UN SERVICIO O NO Y SER DESCONTADO DEL INVENTARIO*/
                   // $cantidad=$cantidad_inventario[0]->cantidad;
                    //$cantidad_final =intval($cantidad)- intval($propiedad['cantidad_producto']);
                    //$actualizar = DB::update('UPDATE inventario SET cantidad='.$cantidad_final.' WHERE id_producto=? AND 7/id_sucursal=?', [$propiedad['id_producto'],$propiedad['id_sucursal_producto']]);    
                
                
            }
            $comentario_historial="Se hizo el pedido";
            $ingresar_historial=DB::insert('INSERT INTO historial_pedido(id_pedido, id_status, fecha_evento, descripcion_evento) VALUES (?,?,?,?)',[$id_venta,1,$fecha_venta,$comentario_historial]);
            //INSERT INTO `historial_pedido`(`id_pedido`, `id_status`, `fecha_evento`, `descripcion_evento`) VALUES ([value-1],[value-2],[value-3],[value-4])
            
            echo 'Pedido realizado, esperando indicaciones de la sucursal';
            DB::commit();
        }catch (Exception $e){
                echo 'Ha ocurrido un error!';
                DB::rollback();
        }  
    }
    
    /*MÉTODO PARA GENERAR UNA CADENA ALEATORIA*/
    function generar_cadena_aleatoria($longitud = 8) 
    {
        $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longitud_caracteres = strlen($caracteres_permitidos);
        $cadena_random = '';
        
        for($i = 0; $i < $longitud; $i++) {
            $caracter_random = $caracteres_permitidos[mt_rand(0, $longitud_caracteres - 1)];
            $cadena_random .= $caracter_random;
        }
        
        /*OBTENER EL NÚMERO DE REGISTROS ACTUAL DE VENTAS*/
        try{
            $query = DB::select('select count(id_pedido) as cant_pedidos from pedido');    
        } catch(Exception $e){
            echo 'Ha ocurrido un error!';
        }
        $ventas_actuales = $query[0]->cant_pedidos;
        
        return $cadena_random."".($ventas_actuales+1);
    }
    
     /*MÉTODO PARA GENERAR FOLIO*/
    function generar_folio($id_sucursal, $id_usuario)
    {
        $id_venta = $id_usuario."".$id_usuario."".PedidoController::generar_cadena_aleatoria();
        
        return $id_venta;
    }
    
    function obtener_usuario_origen($id_sucursal)
    {
        $consulta = DB::select('SELECT * FROM usuario where usuario.id_sucursal='.$id_sucursal);    
        return $id_sucursal_cliente = $consulta[0]->id_usuario;
    }
    
   
}
