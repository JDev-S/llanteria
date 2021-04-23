<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use DB;
class BateriasController extends Controller
{
        public function formato_moneda($valor) 
    {
        if ($valor<0) return "-".formato_moneda(-$valor);
        return '$' . number_format($valor, 2);
    }

    public function mostrar_baterias()
     {
         $aProducto_bateria = array();
        
        $productos = DB::select('select id_productos_llantimax, categoria, nombre, marca, modelo, precio, fotografia_miniatura, caracteristica, descripcion, sucursal, cantidad from ((SELECT productos_llantimax.id_productos_llantimax, categoria.categoria, productos_llantimax.nombre, marca.marca, producto.modelo, productos_servicios.precio, producto.fotografia_miniatura, caracteristica.caracteristica, IFNULL(descripcion_categoria_caracteristica.descripcion, "") as descripcion FROM productos_llantimax inner join productos_servicios on productos_servicios.id_producto_servicio=productos_llantimax.id_productos_llantimax inner join producto on producto.id_producto=productos_servicios.id_producto_servicio INNER JOIN categoria on categoria.id_categoria=producto.id_categoria INNER JOIN caracteristica on categoria.id_categoria=caracteristica.id_categoria left join descripcion_categoria_caracteristica on descripcion_categoria_caracteristica.id_producto_descripcion=producto.id_producto and descripcion_categoria_caracteristica.id_categoria=caracteristica.id_categoria and descripcion_categoria_caracteristica.id_caracteristica=caracteristica.id_caracteristica inner join marca on marca.id_marca=producto.id_marca where categoria.id_categoria=2))as t1 left join inventario on t1.id_productos_llantimax=inventario.id_producto left join sucursal on sucursal.id_sucursal=inventario.id_sucursal  ORDER BY  t1.id_productos_llantimax');
        
         //var_dump($productos);
         //die();
         $oProducto_bateria = new \stdClass();
         
         $auxId_producto = -1;
         $auxCategoria='';
         
         $oProducto_bateria->voltaje='';
         $oProducto_bateria->capacidad_arranque='';
         $oProducto_bateria->capacidad_arranque_frio='';
         $oProducto_bateria->medidas='';
         $oProducto_bateria->peso='';
         $oProducto_bateria->tamanio='';
         
          foreach($productos as $producto)
          {
               if($producto->id_productos_llantimax!==$auxId_producto && $auxId_producto!==-1)
              {
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
              }
              
              $auxId_producto = $producto->id_productos_llantimax;
              
              if($producto->categoria=='Bateria'){
                  
                  $oProducto_bateria->id_productos_llantimax = $producto->id_productos_llantimax;
                  //$oProducto_bateria->sucursal = $producto->sucursal;
                  $oProducto_bateria->categoria = $producto->categoria;
                  $oProducto_bateria->nombre = $producto->nombre;
                  $oProducto_bateria->marca = $producto->marca;
                  $oProducto_bateria->modelo = $producto->modelo;
                  $oProducto_bateria->precio = BateriasController::formato_moneda($producto->precio);
                  $oProducto_bateria->cantidad = $producto->cantidad;
                  $oProducto_bateria->fotografia_miniatura = $producto->fotografia_miniatura;
                  //$oProducto_bateria->sucursal=$producto->sucursal;
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
                      if($producto->categoria=='Bateria')
                      {
                           array_push($aProducto_bateria,$oProducto_bateria);
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
         //$aProducto_llantas = InventarioController::agregar_sucursales_llanta($aProducto_llanta);
         //print_r($aProducto_llantas);
          //echo '<br>';
          //echo '<br>';
          //echo '<br>';
         $aProducto_baterias = BateriasController::agregar_sucursales_bateria($aProducto_bateria);
        //print_r($aProducto_baterias);
        
       
        return view('/principal/productos/baterias/index',compact('aProducto_baterias'));
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
    
public function agregar_sucursales_bateria($aBateria)
    {
        $abaterias = array();
         $oBateria = new \stdClass();
      
         $oBateria->voltaje='';
         $oBateria->capacidad_arranque='';
         $oBateria->capacidad_arranque_frio='';
         $oBateria->medidas='';
         $oBateria->peso='';
         $oBateria->tamanio='';
         $oBateria->id_productos_llantimax =''; 
         $oBateria->categoria = '';
         $oBateria->nombre ='';
         $oBateria->marca = '';
         $oBateria->modelo = '';
         $oBateria->precio = '';
         $oBateria->cantidad = '';
         $oBateria->fotografia_miniatura = '';
         $oBateria->sucursal = '';
         $sucursales=DB::select('select * from sucursal');
         $id_sucu="";
         for($a=0;$a<count($aBateria);$a++)
         {
             if($aBateria[$a]->id_productos_llantimax!=$id_sucu)
             {
              foreach($sucursales as $sucursal)
                 {
                  $id_producto="'".$aBateria[$a]->id_productos_llantimax."'";
                  $query2=DB::select("select inventario.cantidad from inventario where inventario.id_producto=".$id_producto." and   inventario.id_sucursal=".$sucursal->id_sucursal);
                  
                     $oBateria->voltaje=$aBateria[$a]->voltaje;
                     $oBateria->capacidad_arranque=$aBateria[$a]->capacidad_arranque;
                     $oBateria->capacidad_arranque_frio=$aBateria[$a]->capacidad_arranque_frio;
                     $oBateria->medidas=$aBateria[$a]->medidas;
                     $oBateria->peso=$aBateria[$a]->peso;
                     $oBateria->tamanio=$aBateria[$a]->tamanio;
                     $oBateria->id_productos_llantimax =$aBateria[$a]->id_productos_llantimax; 
                     $oBateria->categoria = $aBateria[$a]->categoria;
                     $oBateria->nombre =$aBateria[$a]->nombre;
                     $oBateria->marca = $aBateria[$a]->marca;
                     $oBateria->modelo = $aBateria[$a]->modelo;
                     $oBateria->precio = $aBateria[$a]->precio;
                     $oBateria->cantidad = $query2[0]->cantidad;
                     $oBateria->fotografia_miniatura = $aBateria[$a]->fotografia_miniatura;
                     $oBateria->sucursal = $sucursal->sucursal;
                     array_push($abaterias,$oBateria);
                     $oBateria = new \stdClass();
                     $oBateria->sucursal = '';
                 }
                 $id_sucu=$aBateria[$a]->id_productos_llantimax; 
             }
             else
             {
                 $id_sucu=$aBateria[$a]->id_productos_llantimax; 
             }

         } 
        return $abaterias;
    }

}