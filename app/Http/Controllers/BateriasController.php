<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class BateriasController extends Controller
{
      public function mostrar_baterias ()
    {
       
        $baterias=DB::select('(SELECT productos_llantimax.id_productos_llantimax as id_llanta, categoria.categoria, productos_llantimax.nombre as nombre_bateria, marca.marca, producto.modelo, productos_servicios.precio, producto.fotografia_miniatura as foto, caracteristica.caracteristica, descripcion_categoria_caracteristica.descripcion FROM productos_llantimax inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio INNER JOIN categoria on categoria.id_categoria=producto.id_categoria INNER JOIN caracteristica on categoria.id_categoria=caracteristica.id_categoria left join descripcion_categoria_caracteristica on descripcion_categoria_caracteristica.id_producto_descripcion=producto.id_producto and descripcion_categoria_caracteristica.id_categoria=caracteristica.id_categoria and descripcion_categoria_caracteristica.id_caracteristica=caracteristica.id_caracteristica inner join marca on marca.id_marca=producto.id_marca where categoria.id_categoria=2)
');
             
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
            $id_producto=BateriasController::generar_cadena_aleatoria();
            //app(BateriasController:class)->generar_cadena_aleatoria();
             $ingresar=DB::select('call insertar_producto_universal(?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ? )',[$id_producto,$nombre_bateria,$precio,2,$marca,$fotografia_miniatura,$modelo,'','','','',$voltaje,$capacidad_arranque,$capacidad_arranque_frio,$medidas,$peso,$tamanio]);
            //call insertar_producto_universal(11,'bateria nuevas',200.00,2,1,'fotos','bateriabb','','','','','a','b','c','d','e','f')
            return redirect()->action('BateriasController@mostrar_baterias')->withInput();
        }
       
      
      }
    
    public  function mostrar_formulario()
    {
        return view('/principal/productos/baterias/agregar');
    }
    
    /*MÉTODO PARA GENERAR UNA CADENA ALEATORIA*/
   function  generar_cadena_aleatoria($longitud = 8) 
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
            $query = DB::select('select count(*) as productos from productos_llantimax');    
        } catch(Exception $e){
            echo 'Ha ocurrido un error!';
        }
        $ventas_actuales = $query[0]->productos;
        
        return $cadena_random."".($ventas_actuales+1);
    }
}