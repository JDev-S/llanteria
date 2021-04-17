<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class BateriasController extends Controller
{
      public function mostrar_baterias ()
    {
        $baterias=DB::select('select productos_llantimax.id_productos_llantimax as id_llanta, productos_llantimax.nombre as nombre_bateria, marca.marca as marca, categoria.categoria as categoria, caracteristica.caracteristica as caracteristica, descripcion_categoria_caracteristica.descripcion as descripcion, producto.fotografia_miniatura as foto, productos_servicios.precio as precio from productos_llantimax inner join productos_servicios on productos_llantimax.id_productos_llantimax=productos_servicios.id_producto_servicio inner join producto on productos_servicios.id_producto_servicio=producto.id_producto inner join marca on marca.id_marca=producto.id_marca inner join categoria on categoria.id_categoria=producto.id_categoria inner join caracteristica on caracteristica.id_categoria=categoria.id_categoria inner join descripcion_categoria_caracteristica on descripcion_categoria_caracteristica.id_categoria=caracteristica.id_caracteristica and descripcion_categoria_caracteristica.id_categoria=caracteristica.id_categoria where categoria.id_categoria=2');
             
		return view('/principal/productos/baterias/index',compact('baterias'));
    }

    public function agregar_bateria(Request $input)
	{
        $nombre_bateria = $input['nombre_bateria'];
        
        $precio = $input['precio'];
        //$fotografia_miniatura=$input['fotografia_miniatura'];
        $marca=$input['marca'];
        $modelo=$input['modelo'];
        $voltaje=$input['voltaje'];
        $capacidad_arranque=$input['capacidad_arranque'];
        $capacidad_arranque_frio=$input['capacidad_arranque_frio'];
        $medidas=$input['medidas'];
        $peso=$input['peso'];
        $tamanio=$input['tamanio'];
        
        //echo $nombre_bateria.' '.$precio.' '.$marca.' '.$modelo.' '.$voltaje.' '.$capacidad_arranque.' '.$capacidad_arranque_frio.' '.$medidas.' '.$peso.' '.$tamanio;
        
        
      //echo $nombre_servicio."    ".$precio."     ".$descripcion;
       //return redirect()->back();
        if($input->hasFile('fotografia_miniatura'))
        {
            $file=$input->file('fotografia_miniatura');
            $name=time()."_".$nombre_bateria;
            $file->move(public_path().'/img/',$name);
            $fotografia_miniatura=$name;
            
             $ingresar=DB::select('call insertar_producto_universal(?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ? )',[13,$nombre_bateria,$precio,2,$marca,$fotografia_miniatura,$modelo,'','','','',$voltaje,$capacidad_arranque,$capacidad_arranque_frio,$medidas,$peso,$tamanio]);
            //call insertar_producto_universal(11,'bateria nuevas',200.00,2,1,'fotos','bateriabb','','','','','a','b','c','d','e','f')
        }
       
      
      }
    
    public function mostrar_formulario()
    {
        return view('/principal/productos/baterias/agregar');
    }
}