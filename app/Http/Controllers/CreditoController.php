<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class CreditoController extends Controller
{
    
    public function mostrar_creditos()
       {
        $creditos=DB::select("SELECT credito.id_credito, credito.id_venta, usuario.nombre_completo as nombre_usuario,sucursal.sucursal as sucursal_usuario,clientes.nombre_completo as nombre_cliente,clientes.id_cliente, credito.status_credito, credito.comentario, credito.fecha_ultimo_dia, venta.total_venta, venta.fecha_venta, ifnull(SUM(abono_credito.monto),0.0) as monto FROM credito INNER JOIN venta on venta.id_venta=credito.id_venta LEFT JOIN abono_credito ON abono_credito.id_credito=credito.id_credito INNER JOIN usuario on usuario.id_usuario=venta.id_usuario and usuario.id_sucursal=venta.id_sucursal_usuario inner join sucursal on sucursal.id_sucursal=venta.id_sucursal_usuario inner join clientes on clientes.id_cliente=venta.id_cliente GROUP BY credito.id_credito");
        
         $detalles=DB::select("SELECT productos_llantimax.id_productos_llantimax, productos_llantimax.nombre, cantidad_producto, precio_unidad, total,detalle_venta.id_venta FROM detalle_venta INNER JOIN productos_llantimax on productos_llantimax.id_productos_llantimax=detalle_venta.id_producto");
        
        $abonos=DB::select("select abono_credito.id_abono_credito,abono_credito.id_credito,abono_credito.fecha,abono_credito.monto,abono_credito.comentario from credito inner join abono_credito on credito.id_credito=abono_credito.id_credito");
   
		return view('/principal/credito/index',compact('creditos','detalles','abonos'));
    }
    
    public function agregar_abono(Request $input)
    {
        $id_credito = $input ['id_credito'];
        $id_cliente=$input['id_cliente'];
        $monto = $input ['monto'];
        $comentario = $input ['comentario'];
        
        $fecha_venta= CreditoController::obtener_fecha_actual();
        $id_abono_credito = CreditoController::generar_folio($id_credito, $id_cliente);
        
         $ingresar = DB::insert('INSERT INTO abono_credito(id_abono_credito, id_credito, fecha, monto, comentario) VALUES (?,?,?,?,?)', [$id_abono_credito,$id_credito,$fecha_venta,$monto,$comentario]);
        
        $suma_abonado=CreditoController::obtener_suma_montos($id_credito);
        $total_venta=CreditoController::obtener_total_venta($id_credito);
        if(intval($suma_abonado)==intval($total_venta))
        {
            $query=DB::select("select id_venta from credito where id_credito='".$id_credito."'");
            $id_venta=$query[0]->id_venta;
            $actualizar = DB::update("UPDATE credito SET status_credito='Liquidado' WHERE id_credito=? AND id_venta=?", [$id_credito,$id_venta]);
        }
         echo 'Abono realizado';
        
    }
    
    function obtener_fecha_actual()
    {
        $dia=date("d");
        $mes=date("m");
        $anio=date("Y");
        $fecha =$anio.'-'.$mes.'-'.$dia; 
        
        return $fecha;
    }
    
    
     function generar_folio($id_sucursal, $id_usuario)
    {
        $id_venta = $id_usuario."".$id_usuario."".CreditoController::generar_cadena_aleatoria();
        
        return $id_venta;
    }
    
    
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
            $query = DB::select('select count(*) as abonos from abono_credito');    
        } catch(Exception $e){
            echo 'Ha ocurrido un error!';
        }
        $ventas_actuales = $query[0]->abonos;
        
        return $cadena_random."".($ventas_actuales+1);
    }
    
    function obtener_suma_montos($id_credito)
    {
        try{
            $query=DB::select("select sum(monto) as sumado from abono_credito where id_credito='".$id_credito."'");
        }catch(Exception $e){
            echo 'Ha ocurrido un error!';
        }
        $montos=$query[0]->sumado;
        return $montos;
            
    }
    
     function obtener_total_venta($id_credito)
    {
        
        $query=DB::select("select id_venta from credito where id_credito='".$id_credito."'");
        $id_venta=$query[0]->id_venta;
        $query2=DB::select("select total_venta from venta where id_venta='".$id_venta."'");
        $total=$query2[0]->total_venta;
        return $total;
            
    }


}
