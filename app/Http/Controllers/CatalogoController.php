<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class CatalogoController extends Controller
{
    public function mostrar_formulario()
    {
            return view('/principal/proveedor/catalogo/agregar');
    }
    
        public function mostrar_productos_sucursal_catalogo(Request $input)
    {
        $sucursal = $input['sucursal'];
        $aProducto_proveedor = array();
        if(intval($sucursal)!=0)
        {
            $query=DB::select('select id_productos_llantimax, categoria, nombre, marca, modelo from ((SELECT productos_llantimax.id_productos_llantimax, categoria.categoria, productos_llantimax.nombre, marca.marca, producto.modelo    FROM productos_llantimax inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio INNER JOIN categoria on categoria.id_categoria=producto.id_categoria INNER JOIN caracteristica on categoria.id_categoria=caracteristica.id_categoria left join descripcion_categoria_caracteristica on descripcion_categoria_caracteristica.id_producto_descripcion=producto.id_producto and descripcion_categoria_caracteristica.id_categoria=caracteristica.id_categoria and descripcion_categoria_caracteristica.id_caracteristica=caracteristica.id_caracteristica inner join marca on marca.id_marca=producto.id_marca)

        UNION

        (SELECT productos_llantimax.id_productos_llantimax, (select "Refacción") as categoria, productos_llantimax.nombre, productos_independientes.marca, productos_independientes.modelo from productos_llantimax INNER join productos_independientes on productos_llantimax.id_productos_llantimax=productos_independientes.id_producto_independiente))as t1 left join inventario on t1.id_productos_llantimax=inventario.id_producto left join sucursal on sucursal.id_sucursal=inventario.id_sucursal where inventario.id_sucursal='.$sucursal.' ORDER BY t1.id_productos_llantimax');
            
        $query2=DB::select('SELECT * FROM proveedores where id_sucursal='.$sucursal);
        array_push($aProducto_proveedor,$query);
        array_push($aProducto_proveedor,$query2);
        }
        else
        {
            $query=DB::select('select id_productos_llantimax, categoria, nombre, marca, modelo from ((SELECT productos_llantimax.id_productos_llantimax, categoria.categoria, productos_llantimax.nombre, marca.marca, producto.modelo    FROM productos_llantimax inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio INNER JOIN categoria on categoria.id_categoria=producto.id_categoria INNER JOIN caracteristica on categoria.id_categoria=caracteristica.id_categoria left join descripcion_categoria_caracteristica on descripcion_categoria_caracteristica.id_producto_descripcion=producto.id_producto and descripcion_categoria_caracteristica.id_categoria=caracteristica.id_categoria and descripcion_categoria_caracteristica.id_caracteristica=caracteristica.id_caracteristica inner join marca on marca.id_marca=producto.id_marca)

        UNION

        (SELECT productos_llantimax.id_productos_llantimax, (select "Refacción") as categoria, productos_llantimax.nombre, productos_independientes.marca, productos_independientes.modelo from productos_llantimax INNER join productos_independientes on productos_llantimax.id_productos_llantimax=productos_independientes.id_producto_independiente))as t1 left join inventario on t1.id_productos_llantimax=inventario.id_producto left join sucursal on sucursal.id_sucursal=inventario.id_sucursal  ORDER BY t1.id_productos_llantimax');
        $query2=DB::select('SELECT * FROM proveedores where id_sucursal is null');
        array_push($aProducto_proveedor,$query);
        array_push($aProducto_proveedor,$query2);
        }     
        return response()->json($aProducto_proveedor);
    }
    
    
    
}
