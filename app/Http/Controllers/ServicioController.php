<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;

class ServicioController extends Controller
{
    public function mostrar_servicios()
    {
        $servicios=DB::select('select productos_llantimax.id_productos_llantimax,productos_llantimax.nombre as nombre, productos_servicios.precio as precio, servicio_cliente.id_servicio, servicio_cliente.descripcion as descripcion from productos_llantimax inner join productos_servicios on productos_llantimax.id_productos_llantimax=productos_servicios.id_producto_servicio inner join servicio_cliente on servicio_cliente.id_servicio=productos_servicios.id_producto_servicio');
             
		return view('/principal/servicios/index',compact('servicios'));
    }

    public function agregar_servicio(Request $input)
	{
        $nombre_servicio = $input['nombre'];
        $precio = $input['precio'];
        $descripcion = $input['descripcion'];
      //echo $nombre_servicio."    ".$precio."     ".$descripcion;
       //return redirect()->back();
        $ingresar=DB::select('call insertar_servicio_universal(?, ?, ?, ?)',[5,$nombre_servicio,$precio,$descripcion]);
        
        //CALL insertar_servicio_universal (1,'alineación', 8000.00, 'alineación', 'se hacen un montón de cosas')
         return redirect()->action('ServicioController@mostrar_servicios')->withInput();
      }
    
    public function mostrar_formulario()
    {
        return view('/principal/servicios/agregar');
    }
}
