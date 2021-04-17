<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class RefaccionesController extends Controller
{
    public function mostrar_refacciones ()
    {
        $refacciones=DB::select('select productos_llantimax.id_productos_llantimax as id_refacciones, productos_llantimax.nombre as nombre_refacciones,sucursal.sucursal as sucursal, productos_independientes.precio as precio,productos_independientes.fotografia_miniatura as foto,productos_independientes.marca as marca, productos_independientes.modelo as modelo,productos_independientes.descripcion as descripcion from productos_llantimax inner join productos_independientes on productos_llantimax.id_productos_llantimax=productos_independientes.id_producto_independiente inner join sucursal on sucursal.id_sucursal=productos_independientes.id_sucursal');
             
		return view('/principal/productos/refacciones/index',compact('refacciones'));
    }

    public function agregar_refaccion(Request $input)
	{
        $nombre_refaccion = $input['nombre_refaccion'];
        $sucursal=$input['sucursal'];
        $precio = $input['precio'];
        //$fotografia_miniatura=$input['fotografia_miniatura'];
        $marca=$input['marca'];
        $modelo=$input['modelo'];
        $descripcion = $input['descripcion'];
        
        //secho $nombre_refaccion.' '.$sucursal.' '.$precio.' '.$marca.' '.$modelo.' '.$descripcion;
        
        
      //echo $nombre_servicio."    ".$precio."     ".$descripcion;
       //return redirect()->back();
        if($input->hasFile('fotografia_miniatura'))
        {
            $file=$input->file('fotografia_miniatura');
            $name=time()."_".$nombre_refaccion."_".$sucursal;
            $file->move(public_path().'/img/',$name);
            $fotografia_miniatura=$name;
            
             $ingresar=DB::select('call insertar_producto_independiente(?, ?, ?, ?, ?, ?, ?, ?)',[6,$nombre_refaccion,$sucursal,$precio,$fotografia_miniatura,$marca,$modelo,$descripcion]);
            //return redirect()->action('AlimentosController@alimentos_mostrar')->withInput();
        }
       
      
      }
    
    public function mostrar_formulario()
    {
        return view('/principal/productos/refacciones/agregar');
    }
}