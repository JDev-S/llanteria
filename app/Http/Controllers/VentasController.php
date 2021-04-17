<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class VentasController extends Controller
{
    var $total_venta = 0;
    public function mostrar_productos_ventas()
    {
         $inventarios=DB::select("select inventario.id_producto as id_producto, productos_llantimax.nombre as nombre_producto, categoria.categoria as categoria, marca.marca as marca, producto.modelo as modelo,productos_servicios.precio as precio, producto.fotografia_miniatura as foto, sucursal.sucursal as sucursal, inventario.cantidad as cantidad, sucursal.id_sucursal as id_sucursal from inventario inner join productos_llantimax on productos_llantimax.id_productos_llantimax=inventario.id_producto inner join sucursal on inventario.id_sucursal=sucursal.id_sucursal inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio inner join marca on marca.id_marca=producto.id_marca inner join categoria on categoria.id_categoria=producto.id_categoria

UNION

select inventario.id_producto as id_producto, productos_llantimax.nombre as nombre_producto, (select 'Refacciones' as refaccion), productos_independientes.marca as marca, productos_independientes.modelo as modelo,productos_independientes.precio as precio, productos_independientes.fotografia_miniatura as foto, sucursal.sucursal as sucursal, inventario.cantidad as cantidad, sucursal.id_sucursal as id_sucursal from inventario inner join productos_llantimax on productos_llantimax.id_productos_llantimax=inventario.id_producto inner join sucursal on inventario.id_sucursal=sucursal.id_sucursal inner join productos_independientes on productos_independientes.id_producto_independiente=productos_llantimax.id_productos_llantimax");
             
		return view('/principal/ventas/agregar',compact('inventarios'));
    }
    
    
      /*MÉTODO PARA INSERTAR EN VENTA Y DETALLE DE LA VENTA*/
   public function insertar_venta(Request $input)
	{
        /*RECUPERAR DATOS PARA LA VENTA*/
        $id_usuario = 1;//session
        $id_sucursal_usuario = 1;//session
        $id_sucursal = 1;//session
       
        $id_cliente = $input ['id_cliente'];
        $id_metodo_pago = $input ['id_metodo_pago'];
        //$total_venta = $input ['total_venta'];
        $factura = $input['factura'];
        $array_productos=$input['array_productos'];
        $array_lista_productos = VentasController::array_productos($array_productos);
       
       //foreach($array_productos as $producto){
           
         //  echo $producto['id_producto'];
           //var_dump ($producto);
    //   }
      
         
        $id_sucursal_cliente = VentasController::obtener_sucursal_cliente($id_cliente);
                
        /*DATOS DE LOS PRODUCTOS*/
        /*$array_productos = array(
           array(
               "id_producto" => 1,
                "cantidad_producto" => 5,
                "total" => 500,
                "precio_unidad" => 50,
           ),
           array(
               "id_producto" => 2,
                "cantidad_producto" => 5,
                "total" => 500,
                "precio_unidad" => 50,
           ),
           array(
               "id_producto" => 3,
                "cantidad_producto" => 5,
                "total" => 500,
                "precio_unidad" => 50,
           ),
           array(
               "id_producto" => 4,
                "cantidad_producto" => 5,
                "total" => 500,
                "precio_unidad" => 50,
           )
       ); */
       
        /*OBTENER FECHA ACTUAL*/ 
        $fecha_venta= VentasController::obtener_fecha_actual();
       
        /*GENERAR FOLIO DE VENTA*/
        $id_venta = VentasController::generar_folio($id_sucursal, $id_usuario."".$id_sucursal_usuario, $id_cliente."".$id_sucursal_cliente);
       
        /*INICIAR TRANSACCIÓN*/
       DB::beginTransaction();
        try{
            /*GENERAR VENTA*/
            $ingresar = DB::insert('INSERT INTO venta(id_venta, id_usuario, id_sucursal_usuario, id_sucursal, id_cliente, id_sucursal_cliente, id_metodo_pago, total_venta, fecha_venta, factura) VALUES(?,?,?,?,?,?,?,?,?,?)', [$id_venta, $id_usuario, $id_sucursal_usuario, $id_sucursal, $id_cliente, $id_sucursal_cliente, $id_metodo_pago, $total_venta, $fecha_venta, $factura]);
       
            /*INSERTAR DETALLE DE LA VENTA*/
            foreach($array_lista_productos as $propiedad){
                $ingresar = DB::insert('INSERT INTO detalle_venta (id_venta, id_usuario, id_sucursal_usuario, id_sucursal, id_producto, cantidad_producto, total, precio_unidad) VALUES (?,?,?,?,?,?,?,?)', [$id_venta, $id_usuario, $id_sucursal_usuario, $id_sucursal, $propiedad['id_producto'], $propiedad['cantidad_producto'] , $propiedad['total'] , $propiedad['precio_unidad']]);
            }
            DB::commit();
        }catch (Exception $e){
                echo 'Ha ocurrido un error!';
                DB::rollback();
        }
    }
    
    /*MÉTODO PARA GENERAR FOLIO*/
    function generar_folio($id_sucursal, $id_usuario, $id_cliente)
    {
        $id_venta = $id_usuario."".$id_usuario."".$id_cliente."".VentasController::generar_cadena_aleatoria();
        
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
            $query = DB::select('select count(*) as ventas from venta');    
        } catch(Exception $e){
            echo 'Ha ocurrido un error!';
        }
        $ventas_actuales = $query[0]->ventas;
        
        return $cadena_random."".($ventas_actuales+1);
    }
    
    function obtener_sucursal_cliente($id_cliente)
    {
        $consulta = DB::select('SELECT * FROM clientes where clientes.id_cliente='.$id_cliente);    
        return $id_sucursal_cliente = $consulta[0]->id_sucursal;
    }
    
    function array_productos($array_productos)
    {
        $array_lista_productos = array();
        foreach($array_productos as $producto){
            $id_producto = $producto['id_producto'];
            $consulta = DB::select('select productos_servicios.precio as precio from productos_llantimax inner join productos_servicios on productos_llantimax.id_productos_llantimax=productos_servicios.id_producto_servicio where productos_llantimax.id_productos_llantimax='.$id_producto.
            ' union select productos_independientes.precio as precio from productos_llantimax inner join productos_independientes on productos_llantimax.id_productos_llantimax=productos_independientes.id_producto_independiente where productos_llantimax.id_productos_llantimax='.$id_producto
            );
            
            $id_producto = $producto['id_producto'];
            $cantidad = $producto['cantidad_producto'];
            $precio = $consulta[0]->precio;
            $this->total_venta=$this->total_venta+$precio;
            $totalin=(int)$precio* (int)$cantidad;
            
            echo ' '.$totalin.' ';
           
            $array_lista_productos.array_push(array("id_producto" => $producto['id_producto'],
                                              "cantidad_producto" => $producto['cantidad_producto'],
                                              "precio_unidad" => $consulta[0]->precio,
                                              "total" => $totalin
                                             ));
        }
         die();
        //return $array_lista_productos;
    }
        
}