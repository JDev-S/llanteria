<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Connection;
use App\Http\Controllers\BateriasController;
use DB;
class PedidoController extends Controller
{
    /*PEDIDOS A PROOVEDORES*/
    public function mostrar_pedidos_proveedor()
    {
        $pedidos_proveedores=DB::select("select pv.id_pedido,
                usuario.nombre_completo,
                s1.sucursal as sucursal_usuario,
                s2.sucursal as sucursal_pedido, 
                pv.descripcion, 
                pv.total_venta, 
                pv.fecha_venta
                FROM pedido_proveedor pv
                INNER JOIN sucursal s1 on s1.id_sucursal=pv.id_sucursal 
                INNER JOIN sucursal s2 on s2.id_sucursal=pv.id_sucursal_usuario
                INNER JOIN usuario on usuario.id_usuario=pv.id_usuario and pv.id_sucursal_usuario=s2.id_sucursal
                WHERE pv.id_pedido in (SELECT pedido_proveedor.id_pedido from pedido_proveedor);");
        
        $pedidos_detalles=DB::select("select detalle_pedido_proveedor.id_pedido_proveedor,
	                                  usuario.nombre_completo, 
                                      s2.sucursal as sucursal_usuario,
                                      s1.sucursal as sucursal_pedido,
                                      detalle_pedido_proveedor.total,
                                      detalle_pedido_proveedor.cantidad,
                                      detalle_pedido_proveedor.precio_unidad,
                                      productos_llantimax.nombre,
                                      proveedores.nombre_contacto
                                      FROM detalle_pedido_proveedor 
                                      INNER JOIN pedido_proveedor on pedido_proveedor.id_pedido=detalle_pedido_proveedor.id_pedido_proveedor and detalle_pedido_proveedor.id_usuario=pedido_proveedor.id_usuario and detalle_pedido_proveedor.id_usuario_sucursal=pedido_proveedor.id_sucursal_usuario and pedido_proveedor.id_sucursal=detalle_pedido_proveedor.id_sucursal 
                                      INNER JOIN catalogo on detalle_pedido_proveedor.id_producto=catalogo.id_producto and detalle_pedido_proveedor.id_catalogo=catalogo.id_catalogo 
                                      INNER JOIN productos_llantimax on productos_llantimax.id_productos_llantimax=catalogo.id_producto 
                                      INNER JOIN proveedores on proveedores.id_proveedor=catalogo.id_proveedor 
                                      INNER JOIN usuario on pedido_proveedor.id_usuario=usuario.id_usuario and pedido_proveedor.id_sucursal_usuario=usuario.id_sucursal
                                      INNER JOIN sucursal s1 on s1.id_sucursal=pedido_proveedor.id_sucursal
                                      INNER JOIN sucursal s2 on s2.id_sucursal=pedido_proveedor.id_sucursal_usuario
                                    ");
        
        return view('/principal/pedidos/proveedores/index',compact('pedidos_proveedores','pedidos_detalles'));
                
    }    
    
    /*PEDIDOS A SUCURSALES*/
    
     public function agregar_pedidos_sucursales()
    {
        
    }
    
    public function mostrar_productos_sucursales()
    {
        
    }
    
}
