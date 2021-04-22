<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use App\Http\Controllers\BateriasController;
use DB;
class LlantasController extends Controller
{
        public function mostrar_llantas()
     {
         $aProducto_llanta = array();
        
        $productos = DB::select('select id_productos_llantimax, categoria, nombre, marca, modelo, precio, fotografia_miniatura, caracteristica, descripcion, sucursal, cantidad from ((SELECT productos_llantimax.id_productos_llantimax, categoria.categoria, productos_llantimax.nombre, marca.marca, producto.modelo, productos_servicios.precio, producto.fotografia_miniatura, caracteristica.caracteristica, IFNULL(descripcion_categoria_caracteristica.descripcion, "") as descripcion FROM productos_llantimax inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio INNER JOIN categoria on categoria.id_categoria=producto.id_categoria INNER JOIN caracteristica on categoria.id_categoria=caracteristica.id_categoria left join descripcion_categoria_caracteristica on descripcion_categoria_caracteristica.id_producto_descripcion=producto.id_producto and descripcion_categoria_caracteristica.id_categoria=caracteristica.id_categoria and descripcion_categoria_caracteristica.id_caracteristica=caracteristica.id_caracteristica inner join marca on marca.id_marca=producto.id_marca where categoria.id_categoria=1))as t1 left join inventario on t1.id_productos_llantimax=inventario.id_producto left join sucursal on sucursal.id_sucursal=inventario.id_sucursal  ORDER BY  t1.id_productos_llantimax');
        
         //var_dump($productos);
         //die();
         
         $oProducto_llanta = new \stdClass();
         
         $auxId_producto = -1;
         $auxCategoria='';
         
         $oProducto_llanta->medida = '';
         $oProducto_llanta->capacidad_carga = '';
         $oProducto_llanta->indice_velocidad = '';
         $oProducto_llanta->numero_rin = '';
         
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
                  //$oProducto_llanta->sucursal=$producto->sucursal;
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
              
              if($producto === end($productos))
              {
                  if($producto->categoria=='Llantas')
                  {
                     
                       array_push($aProducto_llanta,$oProducto_llanta);
                  }
              }
          }
          //print_r($aProducto_llanta);
          //echo '<br>';
          //echo '<br>';
          //echo '<br>';
          //print_r($aProducto_bateria);
          //echo '<br>';
          //echo '<br>';
          //echo '<br>';
         $aProducto_llantas = LlantasController::agregar_sucursales_llanta($aProducto_llanta);
         //print_r($aProducto_llantas);
          //echo '<br>';
          //echo '<br>';
          //echo '<br>';
         //$aProducto_baterias = InventarioController::agregar_sucursales_bateria($aProducto_bateria);
        //print_r($aProducto_baterias);
       
        
        return view('/principal/productos/llantas/index',compact('aProducto_llantas'));
     }

    public function agregar_llanta(Request $input)
	{
        $nombre_llanta = $input['nombre_llanta'];
        
        $precio = $input['precio'];
        //$fotografia_miniatura=$input['fotografia_miniatura'];
        $marca=$input['marca'];
        $modelo=$input['modelo'];
        $medida=$input['medida'];
        $capacidad_carga=$input['capacidad_carga'];
        $indice_velocidad=$input['indice_velocidad'];
        $numero_rin=$input['numero_rin'];
        
        //secho $nombre_refaccion.' '.$sucursal.' '.$precio.' '.$marca.' '.$modelo.' '.$descripcion;
        
        
      //echo $nombre_servicio."    ".$precio."     ".$descripcion;
       //return redirect()->back();
        if($input->hasFile('fotografia_miniatura'))
        {
            $file=$input->file('fotografia_miniatura');
            $name=time()."_".$nombre_llanta;
            $file->move(public_path().'/img/',$name);
            $fotografia_miniatura=$name;
            $id_producto=LlantasController::generar_cadena_aleatoria();
            //$id_producto=BateriasController::generar_cadena_aleatoria();
            
             $ingresar=DB::select('call insertar_producto_universal(?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ? )',[$id_producto,$nombre_llanta,$precio,1,$marca,$fotografia_miniatura,$modelo,$medida,$capacidad_carga,$indice_velocidad,$numero_rin,'','','','','','']);
             
        
            //call insertar_producto_universal(8,'llantas nuevas',200.00,1,1,'fotos','llantita','a','b','c','d','','','','','','')
            //return redirect()->action('AlimentosController@alimentos_mostrar')->withInput();
            return redirect()->action('LlantasController@mostrar_llantas')->withInput();
        }
       
      
      }
    
    public function mostrar_formulario()
    {
        return view('/principal/productos/llantas/agregar');
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
    
         function agregar_sucursales_llanta($aLlanta)
    {
         $allantas = array();
         $oLlanta = new \stdClass();
         
         $oLlanta->medida = '';
         $oLlanta->capacidad_carga = '';
         $oLlanta->indice_velocidad = '';
         $oLlanta->numero_rin = '';
         $oLlanta->id_productos_llantimax =''; 
         $oLlanta->categoria = '';
         $oLlanta->nombre ='';
         $oLlanta->marca = '';
         $oLlanta->modelo = '';
         $oLlanta->precio = '';
         $oLlanta->cantidad = '';
         $oLlanta->fotografia_miniatura = '';
         $oLlanta->sucursal = '';
         $sucursales=DB::select('select * from sucursal');
         $id_sucu="";
         
         for($a=0;$a<count($aLlanta);$a++)
         {
                 if(empty($allantas))
                 {
                     foreach($sucursales as $sucursal)
                     {
                         $oLlanta->medida = $aLlanta[$a]->medida;
                         $oLlanta->capacidad_carga = $aLlanta[$a]->capacidad_carga;
                         $oLlanta->indice_velocidad = $aLlanta[$a]->indice_velocidad;
                         $oLlanta->numero_rin = $aLlanta[$a]->numero_rin;
                         $oLlanta->id_productos_llantimax =$aLlanta[$a]->id_productos_llantimax;    
                         $oLlanta->categoria = $aLlanta[$a]->categoria;
                         $oLlanta->nombre =$aLlanta[$a]->nombre;
                         $oLlanta->marca = $aLlanta[$a]->marca;
                         $oLlanta->modelo = $aLlanta[$a]->modelo;
                         $oLlanta->precio = $aLlanta[$a]->precio;
                         $oLlanta->cantidad = $aLlanta[$a]->cantidad;
                         $oLlanta->fotografia_miniatura = $aLlanta[$a]->fotografia_miniatura; 
                         $oLlanta->sucursal = $sucursal->sucursal; 
                         array_push($allantas,$oLlanta);
                         $oLlanta = new \stdClass();
                         $oLlanta->sucursal = '';
                     }
                     
                 }
                 else
                 {
                     $b=0;
                     $bandera=0;
                     while($b<count($allantas))
                     {
                         //echo $aLlanta[$a]->id_productos_llantimax. '=='. $allantas[$b]->id_productos_llantimax;
                         
                         if($aLlanta[$a]->id_productos_llantimax == $allantas[$b]->id_productos_llantimax)
                         {
                            $bandera=1;
                              //echo '<br>';
                             //echo 'sali del ciclo porque lo rompi';
                            //echo '<br>';
                         break; 
                         }
                         else
                         {
                        //      echo '<br>';
                        //     echo 'No esta repetido';
                        //    echo '<br>';
                             $bandera=0;
                             $b=$b+1;
                         }
                         
                     }
                     if($bandera==0)
                     {
                             foreach($sucursales as $sucursal)
                         {
                             $oLlanta->medida = $aLlanta[$a]->medida;
                             $oLlanta->capacidad_carga = $aLlanta[$a]->capacidad_carga;
                             $oLlanta->indice_velocidad = $aLlanta[$a]->indice_velocidad;
                             $oLlanta->numero_rin = $aLlanta[$a]->numero_rin;
                             $oLlanta->id_productos_llantimax =$aLlanta[$a]->id_productos_llantimax;    
                             $oLlanta->categoria = $aLlanta[$a]->categoria;
                             $oLlanta->nombre =$aLlanta[$a]->nombre;
                             $oLlanta->marca = $aLlanta[$a]->marca;
                             $oLlanta->modelo = $aLlanta[$a]->modelo;
                             $oLlanta->precio = $aLlanta[$a]->precio;
                             $oLlanta->cantidad = $aLlanta[$a]->cantidad;
                             $oLlanta->fotografia_miniatura = $aLlanta[$a]->fotografia_miniatura; 
                             $oLlanta->sucursal = $sucursal->sucursal; 
                             array_push($allantas,$oLlanta);
                             $oLlanta = new \stdClass();
                             $oLlanta->sucursal = '';
                         }
                     
                         
                     }
                     else
                     {
                        // echo '<br>';
                          //   echo 'Si esta repetido no se mete';
                        //    echo '<br>';
                         
                     }
                     
                 }
         } 
         
        return $allantas;
    }
}
