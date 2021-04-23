<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use App\Http\Controllers\BateriasController;
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
        $id_producto=ServicioController::generar_cadena_aleatoria();//(new BateriasController)->generar_cadena_aleatoria();////app(BateriasController:class)->generar_cadena_aleatoria();
        $ingresar=DB::select('call insertar_servicio_universal(?, ?, ?, ?)',[$id_producto,$nombre_servicio,$precio,$descripcion]);
        
        
      }
    
    public function mostrar_formulario()
    {
        return view('/principal/servicios/agregar');
    }
    
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
