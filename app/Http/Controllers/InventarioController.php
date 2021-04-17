<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class InventarioController extends Controller
{
    
      public function mostrar_inventarios ()
    {
        $inventarios=DB::select("select inventario.id_producto as id_producto, productos_llantimax.nombre as nombre_producto, categoria.categoria as categoria, marca.marca as marca, producto.modelo as modelo,productos_servicios.precio as precio, producto.fotografia_miniatura as foto, sucursal.sucursal as sucursal, inventario.cantidad as cantidad from inventario inner join productos_llantimax on productos_llantimax.id_productos_llantimax=inventario.id_producto inner join sucursal on inventario.id_sucursal=sucursal.id_sucursal inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio inner join marca on marca.id_marca=producto.id_marca inner join categoria on categoria.id_categoria=producto.id_categoria

UNION

select inventario.id_producto as id_producto, productos_llantimax.nombre as nombre_producto, (select 'Refacciones' as refaccion), productos_independientes.marca as marca, productos_independientes.modelo as modelo,productos_independientes.precio as precio, productos_independientes.fotografia_miniatura as foto, sucursal.sucursal as sucursal, inventario.cantidad as cantidad from inventario inner join productos_llantimax on productos_llantimax.id_productos_llantimax=inventario.id_producto inner join sucursal on inventario.id_sucursal=sucursal.id_sucursal inner join productos_independientes on productos_independientes.id_producto_independiente=productos_llantimax.id_productos_llantimax");
             
		return view('/principal/inventario/index',compact('inventarios'));
    }
    
    
     public function agregar_inventario(Request $input)
	{
        $producto = $input['producto'];
        $sucursal = $input['sucursal'];
        $cantidad = $input['cantidad'];
            
        $ingresar=DB::insert('insert into inventario (id_producto, id_sucursal, cantidad) values( ?, ?, ?)', [$producto,$sucursal, $cantidad]);
        
        // INSERT INTO inventario(id_producto, id_sucursal, cantidad) VALUES (1,2,20)
        
         return redirect()->action('InventarioController@mostrar_inventarios')->withInput();
      }
    
    public function mostrar_formulario()
    {
         return view('/principal/inventario/agregar');
    }
    
}
