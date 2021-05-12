<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use App\Http\Controllers\BateriasController;
use DB;
class ProveedorController extends Controller
{
    public function mostrar_proveedor ()
    {
        $proveedores=DB::select('select proveedores.id_proveedor, rol_proveedor.rol_proveedor, proveedores.nombre_empresa,proveedores.telefono,proveedores.direccion,proveedores.nombre_contacto,proveedores.correo_electronico,IFNULL(sucursal.sucursal, "Prveedor general") as sucursal from proveedores inner join rol_proveedor on proveedores.id_rol_proveedor=rol_proveedor.id_rol_proveedor left join sucursal on sucursal.id_sucursal=proveedores.id_sucursal');
             
		return view('/principal/proveedor/index',compact('proveedores'));
    }
    
    
    
    
    public function agregar_proveedor(Request $input)
	{
        $nombre_contacto = $input['nombre_contacto'];
        $sucursal = $input['sucursal'];
        $nombre_empresa = $input['nombre_empresa'];
        $telefono = $input['telefono'];
        $direccion=$input['direccion'];
        $correo=$input['correo'];
        
        if(intval($sucursal)==0)
        {
            $id_rol_proveedor=1;
             $query3=DB::insert('insert into proveedores(id_proveedor, id_sucursal, id_rol_proveedor, nombre_empresa, telefono, direccion, nombre_contacto, correo_electronico) values( ?, ?, ?, ?, ?, ?, ?, ?)', [null, null, $id_rol_proveedor,$nombre_empresa,$telefono,$direccion,$nombre_contacto,$correo]);
            
        }
        else
        {
            $id_rol_proveedor=2;
            $query3=DB::insert('insert into proveedores(id_proveedor, id_sucursal, id_rol_proveedor, nombre_empresa, telefono, direccion, nombre_contacto, correo_electronico) values( ?, ?, ?, ?, ?, ?, ?, ?)', [null, $sucursal, $id_rol_proveedor,$nombre_empresa,$telefono,$direccion,$nombre_contacto,$correo]);
        }
         return redirect()->action('ProveedorController@mostrar_proveedor')->withInput();
      }
    
    public function mostrar_formulario()
    {
        return view('/principal/proveedor/agregar');
    }

}
