<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class LlantasController extends Controller
{
   public function mostrar_llantas ()
    {
        $llantas=DB::select('select productos_llantimax.id_productos_llantimax as id_llanta, productos_llantimax.nombre as nombre_llanta, marca.marca as marca, categoria.categoria as categoria, caracteristica.caracteristica as caracteristica, descripcion_categoria_caracteristica.descripcion as descripcion, producto.fotografia_miniatura as foto, productos_servicios.precio as precio from productos_llantimax inner join productos_servicios on productos_llantimax.id_productos_llantimax=productos_servicios.id_producto_servicio inner join producto on productos_servicios.id_producto_servicio=producto.id_producto inner join marca on marca.id_marca=producto.id_marca inner join categoria on categoria.id_categoria=producto.id_categoria inner join caracteristica on caracteristica.id_categoria=categoria.id_categoria inner join descripcion_categoria_caracteristica on descripcion_categoria_caracteristica.id_categoria=caracteristica.id_caracteristica and descripcion_categoria_caracteristica.id_categoria=caracteristica.id_categoria where categoria.id_categoria=1');
             
		return view('/principal/productos/llantas/index',compact('llantas'));
    }

    public function agregar_llanta(Request $input)
	{
        $nombre_llanta = $input['nombre_llanta'];
        
        $precio = $input['precio'];
        //$fotografia_miniatura=$input['fotografia_miniatura'];
        $marca=$input['marca'];
        $modelo=$input['modelo'];
        $medida=$input['medida'];
        $capacidad_carga=$input['capacidad_carga'];
        $indice_velocidad=$input['indice_velocidad'];
        $numero_rin=$input['numero_rin'];
        
        //secho $nombre_refaccion.' '.$sucursal.' '.$precio.' '.$marca.' '.$modelo.' '.$descripcion;
        
        
      //echo $nombre_servicio."    ".$precio."     ".$descripcion;
       //return redirect()->back();
        if($input->hasFile('fotografia_miniatura'))
        {
            $file=$input->file('fotografia_miniatura');
            $name=time()."_".$nombre_llanta;
            $file->move(public_path().'/img/',$name);
            $fotografia_miniatura=$name;
            
             $ingresar=DB::select('call insertar_producto_universal(?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ? )',[11,$nombre_llanta,$precio,1,$marca,$fotografia_miniatura,$modelo,$medida,$capacidad_carga,$indice_velocidad,$numero_rin,'','','','','','']);
            //call insertar_producto_universal(8,'llantas nuevas',200.00,1,1,'fotos','llantita','a','b','c','d','','','','','','')
            //return redirect()->action('AlimentosController@alimentos_mostrar')->withInput();
        }
       
      
      }
    
    public function mostrar_formulario()
    {
        return view('/principal/productos/llantas/agregar');
    }
}