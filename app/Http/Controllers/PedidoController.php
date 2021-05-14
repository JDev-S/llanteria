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
    
    
    /*PEDIDOS A SUCURSALES*/
    
     public function agregar_pedidos_sucursales()
    {
        
    }
    
    public function mostrar_productos_sucursales()
    {
        
    }
    
}
