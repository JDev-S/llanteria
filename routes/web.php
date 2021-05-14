<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*Inicio de sesion de llantimax*/
/*Mostrar formulario */
Route::get('/','LoginController@mostrar_login');
/*Mandar credenciales*/
Route::post('/iniciar_sesion','LoginController@Login')->name('iniciar_sesion');
/*Cerrar sesion*/
Route::get('/cerrar_sesion','LoginController@Logout');

/*mostrar cambiar la contrasenia*/
Route::get('/cambiar_contrasenia', function () {
    return view('olvide_contrasenia');
});

/*Cambiar contraseña*/
Route::post('/obtener_contrasenia','LoginController@obtener_contraseña')->name('obtener_contrasenia');


/*Mandar a la principal*/
Route::get('/principal','LoginController@mostrar_principal')->middleware('admin:1')->name('principal');
/*CLIENTES*/
/*Mostrar clientes*/
Route::get('/mostrar_clientes','ClientesController@mostrar_clientes')->middleware('admin:1')->name('mostrar_clientes');

/*Mostrar formulario de cliente*/

Route::get('/agregar_cliente','ClientesController@mostrar_formulario')->middleware('admin:1')->name('agregar_cliente');

/*Agregar un cliente*/
Route::post('/agregar_clientes', 'ClientesController@agregar_cliente')->name('agregar_cliente');

/*Proovedores*/
/*Mostrar proveedores*/
Route::get('/mostrar_proveedores','ProveedorController@mostrar_proveedor')->middleware('admin:1')->name('mostrar_proveedores');
/*Mostrar formulario de proveedores*/
Route::get('/agregar_proveedor','ProveedorController@mostrar_formulario')->middleware('admin:1')->name('agregar_cliente');
/*Agregar un proveedor*/
Route::post('/agregar_proveedores', 'ProveedorController@agregar_proveedor')->name('agregar_proveedores');

/*Catalogo*/
/*mostrar formulario para agregar catalogo*/
Route::get('/agregar_catalogo','CatalogoController@mostrar_formulario')->middleware('admin:1')->name('agregar_catalogo');
/*Mostrar productos en el formulario de catalogo*/
Route::post('/mostrar_productos_catalogo','CatalogoController@mostrar_productos_sucursal_catalogo')-> name('mostrar_productos_catalogo');


/*Pedidos sucursales*/
/*Mostrar productos de las sucursales*/
//Route::get('/mostrar_productos_sucursales/{sucursal?}','PedidoController@mostrar_productos_sucursales');

/*INVENTARIO*/
/*Mostrar inventario*/

Route::get('/mostrar_inventario','InventarioController@mostrar_inventarios')->middleware('admin:1')->name('mostrar_inventario');

/*Mostrar formulario de inventario*/

Route::get('/agregar_inventario','InventarioController@mostrar_formulario')->middleware('admin:1')->name('agregar_inventario');

/*Agregar un producto en inventario*/
Route::post('/agregar_inventarios', 'InventarioController@agregar_inventario')->name('agregar_inventarios');

/*Mostrar productos en el formulario de inventario*/
Route::post('/mostrar_productos','InventarioController@mostrar_productos_sucursal_inventario')->name('mostrar_productos');

/*SERVICIOS*/
/*Mostrar servicios*/
Route::get('/mostrar_servicios','ServicioController@mostrar_servicios')->middleware('admin:1')->name('mostrar_servicios');

/*Mostrar formulario de servicio*/

Route::get('/agregar_servicio','ServicioController@mostrar_formulario')->middleware('admin:1')->name('agregar_servicio');

/*Agregar un servicio*/
Route::post('/agregar_servicios', 'ServicioController@agregar_servicio')->name('agregar_servicios');


/*Refacciones*/
/*Mostrar refacciones*/
Route::get('/mostrar_refacciones','RefaccionesController@mostrar_refacciones')->middleware('admin:1')->name('mostrar_refacciones');

/*Mostrar formulario de refaccion*/

Route::get('/agregar_refaccion','RefaccionesController@mostrar_formulario')->middleware('admin:1')->name('agregar_refaccion');

/*Agregar una refaccion*/
Route::post('/agregar_refacciones', 'RefaccionesController@agregar_refaccion')->name('agregar_refacciones');


/*Llantas*/
/*Mostrar Llantas*/
Route::get('/mostrar_llantas','LlantasController@mostrar_llantas')->middleware('admin:1')->name('mostrar_llantas');

/*Mostrar formulario de llanta*/

Route::get('/agregar_llanta','LlantasController@mostrar_formulario')->middleware('admin:1')->name('agregar_llanta');

/*Agregar una llanta*/
Route::post('/agregar_llantas', 'LlantasController@agregar_llanta')->name('agregar_llantas');


/*Baterias*/
/*Mostrar Baterias*/
Route::get('/mostrar_baterias','BateriasController@mostrar_baterias')->middleware('admin:1')->name('mostrar_baterias');

/*Mostrar formulario de bateria*/

Route::get('/agregar_bateria','BateriasController@mostrar_formulario')->middleware('admin:1')->name('agregar_bateria');

/*Agregar una bateria*/
Route::post('/agregar_baterias', 'BateriasController@agregar_bateria')->name('agregar_baterias');


/*  Ventas*/
/* Vista para hacer la venta */
/*Mostrar ventas*/
Route::get('/mostrar_venta','VentasController@mostrar_ventas_realizadas')->middleware('admin:1')->name('mostrar_venta');
/*Mostrar Formulario de generar venta*/
Route::get('/agregar_venta','VentasController@mostrar_productos_ventas')->middleware('admin:1')->name('agregar_venta');

Route::post('/insertar_venta', 'VentasController@insertar_venta')->name('insertar_venta');

/*PEDIDOS A PROVEEDORES*/
/*Mostrar pedidos a proveedores*/
Route::get('/mostrar_pedido_proveedor','PedidoController@mostrar_pedidos_proveedor')->middleware('admin:1')
->name('mostrar_pedido_proveedor');
/*Mostrar pedidos en proveedores*/
Route::get('/mostrar_catalogo','PedidoController@mostrar_catalogo_proveedores')->middleware('admin:1')->name('mostrar_catalogo');
/*Agregar un pedido en el proveedor*/
Route::post('insertar_pedido_proveedor','PedidoController@generar_pedido_proveedor')->name('insertar_pedido_proveedor');