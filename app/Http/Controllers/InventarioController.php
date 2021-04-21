<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use DB;
class InventarioController extends Controller
{
    
      /*public function mostrar_inventarios ()
    {
        
        $inventarios=DB::select("select * from ((SELECT productos_llantimax.id_productos_llantimax, categoria.categoria, productos_llantimax.nombre as nombre_producto, marca.marca, producto.modelo, productos_servicios.precio, producto.fotografia_miniatura as foto, caracteristica.caracteristica, descripcion_categoria_caracteristica.descripcion FROM productos_llantimax inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio INNER JOIN categoria on categoria.id_categoria=producto.id_categoria INNER JOIN caracteristica on categoria.id_categoria=caracteristica.id_categoria left join descripcion_categoria_caracteristica on descripcion_categoria_caracteristica.id_producto_descripcion=producto.id_producto and descripcion_categoria_caracteristica.id_categoria=caracteristica.id_categoria and descripcion_categoria_caracteristica.id_caracteristica=caracteristica.id_caracteristica inner join marca on marca.id_marca=producto.id_marca)

UNION

(SELECT productos_llantimax.id_productos_llantimax, (select 'Refacción') as categoria, productos_llantimax.nombre as nombre_producto, productos_independientes.marca, productos_independientes.modelo, productos_independientes.precio, productos_independientes.fotografia_miniatura as foto, (select 'Descripción') as caracteristica, productos_independientes.descripcion from productos_llantimax INNER join productos_independientes on productos_llantimax.id_productos_llantimax=productos_independientes.id_producto_independiente))as t1 left join inventario on t1.id_productos_llantimax=inventario.id_producto left join sucursal on sucursal.id_sucursal=inventario.id_sucursal ORDER BY t1.id_productos_llantimax");
             
		return view('/principal/inventario/index',compact('inventarios'));
    }*/
    
    
     public function agregar_inventario(Request $input)
	{
        $producto = $input['producto'];
        $sucursal = $input['sucursal'];
        $cantidad = $input['cantidad'];
            
        $ingresar=DB::insert('insert into inventario (id_producto, id_sucursal, cantidad) values( ?, ?, ?)', [$producto,$sucursal, $cantidad]);
        
        // INSERT INTO inventario(id_producto, id_sucursal, cantidad) VALUES (1,2,20)
        
         return redirect()->action('InventarioController@mostrar_inventarios')->withInput();
      }
    
    public function mostrar_formulario()
    {
         return view('/principal/inventario/agregar');
    }
    
    public function mostrar_inventarios()
     {
         $aProducto_bateria = array();
         $aProducto_llanta = array();
         $aProducto_refaccion = array();
         $id_sucursal=session('id_sucursal_usuario');
         
        $productos = DB::select('select id_productos_llantimax, categoria, nombre, marca, modelo, precio, fotografia_miniatura, caracteristica, descripcion, sucursal, cantidad from ((SELECT productos_llantimax.id_productos_llantimax, categoria.categoria, productos_llantimax.nombre, marca.marca, producto.modelo, productos_servicios.precio, producto.fotografia_miniatura, caracteristica.caracteristica, IFNULL(descripcion_categoria_caracteristica.descripcion, "") as descripcion FROM productos_llantimax inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio INNER JOIN categoria on categoria.id_categoria=producto.id_categoria INNER JOIN caracteristica on categoria.id_categoria=caracteristica.id_categoria left join descripcion_categoria_caracteristica on descripcion_categoria_caracteristica.id_producto_descripcion=producto.id_producto and descripcion_categoria_caracteristica.id_categoria=caracteristica.id_categoria and descripcion_categoria_caracteristica.id_caracteristica=caracteristica.id_caracteristica inner join marca on marca.id_marca=producto.id_marca)

        UNION

        (SELECT productos_llantimax.id_productos_llantimax, (select "Refacción") as categoria, productos_llantimax.nombre, productos_independientes.marca, productos_independientes.modelo, productos_independientes.precio, productos_independientes.fotografia_miniatura, (select "Descripción") as caracteristica, IFNULL(productos_independientes.descripcion,"") as descripcion from productos_llantimax INNER join productos_independientes on productos_llantimax.id_productos_llantimax=productos_independientes.id_producto_independiente))as t1 left join inventario on t1.id_productos_llantimax=inventario.id_producto left join sucursal on sucursal.id_sucursal=inventario.id_sucursal where inventario.id_sucursal='.$id_sucursal.' ORDER BY t1.id_productos_llantimax');
         
         //var_dump($productos);
        // die();
         
         $oProducto_llanta = new \stdClass();
         $oProducto_refaccion = new \stdClass();
         $oProducto_bateria = new \stdClass();
         
         $auxId_producto = -1;
         $auxCategoria='';
         
         $oProducto_llanta->medida = '';
         $oProducto_llanta->capacidad_carga = '';
         $oProducto_llanta->indice_velocidad = '';
         $oProducto_llanta->numero_rin = '';
         
         $oProducto_bateria->voltaje='';
         $oProducto_bateria->capacidad_arranque='';
         $oProducto_bateria->capacidad_arranque_frio='';
         $oProducto_bateria->medidas='';
         $oProducto_bateria->peso='';
         $oProducto_bateria->tamanio='';
         
         $oProducto_refaccion->descripcion='';
         
          foreach($productos as $producto)
          {
               if($producto->id_productos_llantimax!==$auxId_producto && $auxId_producto!==-1)
              {
                   if($auxCategoria=='Llantas')
                   {
                      array_push($aProducto_llanta,$oProducto_llanta);
                      $oProducto_llanta = new \stdClass();

                      $oProducto_llanta->medida = '';
                      $oProducto_llanta->capacidad_carga = '';
                      $oProducto_llanta->indice_velocidad = '';
                      $oProducto_llanta->numero_rin = '';
                   }
                   else
                       if($auxCategoria=='Bateria')
                       {
                            array_push($aProducto_bateria,$oProducto_bateria);
                            $oProducto_bateria = new \stdClass();
                           
                            $oProducto_bateria->voltaje='';
                            $oProducto_bateria->capacidad_arranque='';
                            $oProducto_bateria->capacidad_arranque_frio='';
                            $oProducto_bateria->medidas='';
                            $oProducto_bateria->peso='';
                            $oProducto_bateria->tamanio='';
                       }
                   else
                   {
                       if($auxCategoria=='Refacción')
                       {
                            array_push($aProducto_refaccion,$oProducto_refaccion);
                            $oProducto_refaccion = new \stdClass();

                           $oProducto_refaccion->descripcion='';
                       }
                   }
              }
              
              $auxId_producto = $producto->id_productos_llantimax;
              
              if($producto->categoria=='Llantas'){
                  $oProducto_llanta->id_productos_llantimax = $producto->id_productos_llantimax;
                  //$oProducto_llanta->sucursal = $producto->sucursal;
                  $oProducto_llanta->categoria = $producto->categoria;
                  $oProducto_llanta->nombre = $producto->nombre;
                  $oProducto_llanta->marca = $producto->marca;
                  $oProducto_llanta->modelo = $producto->modelo;
                  $oProducto_llanta->precio = $producto->precio;
                  $oProducto_llanta->cantidad = $producto->cantidad;
                  $oProducto_llanta->fotografia_miniatura = $producto->fotografia_miniatura;
                  $auxCategoria='Llantas';

                  if($producto->caracteristica=='Medida')
                  {
                       $oProducto_llanta->medida = $producto->descripcion;
                  }
                  else
                  {
                      if($producto->caracteristica=='Capacidad de carga')
                      {
                          $oProducto_llanta->capacidad_carga = $producto->descripcion;
                      }
                      else
                      {
                           if($producto->caracteristica=='Indice de velocidad')
                           {
                                $oProducto_llanta->indice_velocidad = $producto->descripcion;
                           }
                          else
                          {
                             if($producto->caracteristica=='Numero de rin')
                             {
                                    $oProducto_llanta->numero_rin = $producto->descripcion;
                             } 
                          }
                      }
                  }
              }
              
              if($producto->categoria=='Refacción'){
                  
                  $oProducto_refaccion->id_productos_llantimax = $producto->id_productos_llantimax;
                  //$oProducto_refaccion->sucursal = $producto->sucursal;
                  $oProducto_refaccion->categoria = $producto->categoria;
                  $oProducto_refaccion->nombre = $producto->nombre;
                  $oProducto_refaccion->marca = $producto->marca;
                  $oProducto_refaccion->modelo = $producto->modelo;
                  $oProducto_refaccion->precio = $producto->precio;
                  $oProducto_refaccion->cantidad = $producto->cantidad;
                  $oProducto_refaccion->fotografia_miniatura = $producto->fotografia_miniatura;
                  
                  $oProducto_refaccion->descripcion = $producto->descripcion;
                  $auxCategoria='Refacción';
              }
              
              if($producto->categoria=='Bateria'){
                  
                  $oProducto_bateria->id_productos_llantimax = $producto->id_productos_llantimax;
                  //$oProducto_bateria->sucursal = $producto->sucursal;
                  $oProducto_bateria->categoria = $producto->categoria;
                  $oProducto_bateria->nombre = $producto->nombre;
                  $oProducto_bateria->marca = $producto->marca;
                  $oProducto_bateria->modelo = $producto->modelo;
                  $oProducto_bateria->precio = $producto->precio;
                  $oProducto_bateria->cantidad = $producto->cantidad;
                  $oProducto_bateria->fotografia_miniatura = $producto->fotografia_miniatura;
                  $auxCategoria='Bateria';

                  if($producto->caracteristica=='Voltaje')
                  {
                       $oProducto_bateria->voltaje = $producto->descripcion;
                  }
                  else
                  {
                      if($producto->caracteristica=='Capacidad de arranque')
                      {
                          $oProducto_bateria->capacidad_arranque = $producto->descripcion;
                      }
                      else
                      {
                           if($producto->caracteristica=='Capacidad de arranque en frio')
                           {
                                $oProducto_bateria->capacidad_arranque_frio = $producto->descripcion;
                           }
                           else
                           {
                              if($producto->caracteristica=='Medidas')
                              {
                                    $oProducto_bateria->medidas = $producto->descripcion;
                              }
                               else
                               {
                                   if($producto->caracteristica=='Peso')
                                   {
                                       $oProducto_bateria->peso = $producto->descripcion;
                                   }
                                   else
                                   {
                                       if($producto->caracteristica=='Tamaño')
                                       {
                                           $oProducto_bateria->tamanio = $producto->descripcion;
                                       }
                                   }
                               }
                           }
                      }
                  }
              }
              
              if($producto === end($productos))
              {
                  if($producto->categoria=='Llantas')
                  {
                       array_push($aProducto_llanta,$oProducto_llanta);
                  }
                  else
                  {
                      if($producto->categoria=='Bateria')
                      {
                           array_push($aProducto_bateria,$oProducto_bateria);
                      }
                      else
                      {
                          if($producto->categoria=='Refacción')
                          {
                           
                               array_push($aProducto_refaccion,$oProducto_refaccion);
                          }
                      }
                  }
              }
          }
        /* print_r($aProducto_refaccion);
        echo '<br>';
        echo '<br>';
        echo '<br>';
         print_r($aProducto_llanta);
        echo '<br>';
        echo '<br>';
        echo '<br>';
         print_r($aProducto_bateria);
         die();*/
        
    
        
        return view('/principal/inventario/index',compact('aProducto_bateria','aProducto_llanta','aProducto_refaccion'));
        
     }

    
}
