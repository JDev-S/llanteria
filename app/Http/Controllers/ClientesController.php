<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class ClientesController extends Controller
{
  
     public function mostrar_clientes ()
    {
        $clientes=DB::select('select clientes.id_cliente as id_cliente, clientes.fecha_registro as fecha, clientes.nombre_completo as nombre_completo, clientes.telefono as telefono,clientes.correo_electronico as correo,sucursal.sucursal as sucursal,clientes.cliente_habitual  from clientes inner join sucursal on sucursal.id_sucursal=clientes.id_sucursal');
             
		return view('/principal/clientes/index',compact('clientes'));
    }
    
    // $query3=DB::insert('insert into imagenes_color (id_imagen_color, id_alimento, imagen_color) values( ?, ?, ?)', [null, $id_alimento, $imagen2]);
    
    
    public function agregar_cliente(Request $input)
	{
        $nombre_cliente = $input['nombre'];
        $telefono = $input['telefono'];
        $correo = $input['correo'];
        $sucursal = $input['sucursal'];
        $cliente_habitual=$input['habitual'];
        
        $dia=date("d");
        $mes=date("m");
        $anio=date("Y");
        $fecha=$anio.'-'.$mes.'-'.$dia;
            
   //echo $fecha.' '.$nombre_cliente.' '.$telefono.' '.$correo.' '.$sucursal.' '.$cliente_habitual;
        
        $ingresar=DB::insert('insert into clientes (id_cliente, fecha_registro, nombre_completo, telefono,correo_electronico, id_sucursal, cliente_habitual) values( ?, ?, ?, ?, ?, ?, ?)', [2,$fecha,$nombre_cliente, $telefono, $correo, $sucursal, $cliente_habitual]);
        
        //INSERT INTO clientes(id_cliente, fecha_registro, nombre_completo, telefono,correo_electronico, id_sucursal, cliente_habitual) VALUES (1, '12/04/2021', 'Maximiliano Gabriel', '123456','max@gmail.com',2,1);

        //CALL insertar_servicio_universal (1,'alineación', 8000.00, 'alineación', 'se hacen un montón de cosas')
         return redirect()->action('ClientesController@mostrar_clientes')->withInput();
      }
    
    public function mostrar_formulario()
    {
        return view('/principal/clientes/agregar');
    }

}
