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



Route::get(
    'error', function () {
        abort('404');
    }
);

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::post('dashboard', 'DashboardController@horario')->name('horario');
Route::get('login', 'Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::get('registro', 'RegistroController@index')->name('registro');
Route::post('registro', 'RegistroController@store')->name('registro.store');

Route::get('cupones/crear', 'CuponController@create')->name('cupones.create');
Route::post('cupones', 'CuponController@store')->name('cupones.store');
Route::get('cupones', 'CuponController@index')->name('cupones.index');
Route::delete('cupones/{id}', 'CuponController@destroy')->name('cupones.destroy');

Route::get('/', 'ClienteController@index')->name('inicio');
Route::get('panel/paginas/inicio', 'InicioController@index')->name('admin.inicio');
Route::patch('panel/paginas/inicio', 'InicioController@guardar')->name('admin.inicio.store');

Route::get('contacto', 'ContactoController@contacto')->name('index.contacto');
Route::post('contacto', 'ContactoController@send_contacto')->name('send_contacto.contacto');

Route::get('menu', 'ClienteController@menuIndex')->name('cliente.menu.index');
Route::get('menu/{menu}', 'ClienteController@menu_single')->name('cliente.menu.show');
Route::get('carta/{menu}', 'ClienteController@carta')->name('cliente.carta.show');
Route::get('ordenar-online', 'ClienteController@ordenar_online')->name('ordenar_online');
Route::post('ordenar-online/{idalimento}/{cantidad?}', 'ClienteController@add_cart')->name('add_cart');
//new
Route::get('ordenar-online/producto/{idalimento}', 'ClienteController@show_producto')->name('show_producto');
Route::post('ordenar-online/producto/{idalimento}', 'ClienteController@add_cart_subproductos')->name('add_cart_subproductos');
Route::get('ordenar-online/producto/edit/{id}', 'ClienteController@edit_producto')->name('edit_producto');
Route::post('ordenar-online/producto/edit/{id}', 'ClienteController@update_producto')->name('update_producto');


Route::get('faq', 'ClienteController@faq')->name('faq');

Route::get('cuenta/historial', 'ClienteController@ordenes')->name('ordenes');
Route::get('cuenta/hoy', 'ClienteController@hoy')->name('hoy');
Route::get('ofertas', 'ClienteController@ofertas')->name('ofertas');
//Route::post('cuenta/charge','ClienteController@charge')->name('charge');

Route::post('/guardar_informacion_pedido', 'CarritoController@guardarInformacionPedido')->name('guardar_informacion_pedido');
Route::get('cuenta/carrito', 'ClienteController@open_carrito')->name('open_carrito');
Route::delete('cuenta/carrito/{id}', 'ClienteController@destroy_carrito')->name('destroy_carrito');
Route::patch('cuenta/carrito/change-type', 'CarritoController@changeType')->name('carrito.change-type');
Route::patch('cuenta/carrito/{carrito}', 'CarritoController@update')->name('carrito.update');
Route::patch('cuenta/carrito/apply-coupon/{cupon}', 'CarritoController@applyCoupon')->name('apply-coupon');
Route::delete('/eliminar-cupon/{id}', 'CuponController@delete');
Route::get('/obtener-cupones', 'CuponController@obtener');
Route::get('cuenta/pedido/{productos}/{iduser}/{direccion}/{total}/{token}/{metodo}', 'ClienteController@generar_pedido')->name('generar_pedido');


Route::get('panel/mensajes', 'MensajeController@index')->name('index.mensaje');
Route::delete('panel/mensajes/{id}', 'MensajeController@destroy')->name('destroy.mensaje');

Route::get('panel/configuraciones/general', 'ConfigController@index')->name('admin.general');
Route::patch('panel/configuraciones/general', 'ConfigController@guardar')->name('admin.general.store');
Route::get('panel/sync-hosteltactil', 'ConfigController@syncHostelTactil')->name('admin.general.sync-hosteltactil');

Route::get('panel/data/productos', 'ProductoController@index')->name('admin.producto');
Route::get('panel/data/productos/registrar', 'ProductoController@create')->name('registrar.producto');
Route::post('panel/data/productos/registrar', 'ProductoController@store')->name('store.producto');

Route::get('panel/data/producto/{id}', 'ProductoController@edit')->name('edit.producto');
Route::patch('panel/data/producto/{id}', 'ProductoController@update')->name('update.producto');
Route::patch('panel/data/producto/estado/{id}', 'ProductoController@estado')->name('estado.producto');
Route::delete('panel/data/producto/{id}', 'ProductoController@eliminar')->name('eliminar.producto');
Route::patch('panel/data/producto/oferta/{id}', 'ProductoController@oferta')->name('oferta.producto');
Route::get('panel/data/productos/ofertas', 'ProductoController@index_oferta')->name('index_oferta.producto');
Route::patch('panel/data/productos/ofertas_portada/{id}', 'ProductoController@update_portada')->name('update_portada.producto');
//NUEVAS RUTAS
Route::get('panel/data/producto/{id}/combinados', 'ProductoController@edit_combinados')->name('edit.producto_combinados');
Route::post('panel/data/producto/{producto}/combinados', 'ProductoController@update_combinados')->name('update.producto_combinados');
Route::delete('panel/data/producto/{producto}/combinados/{combinado}', 'ProductoController@eliminar_combinados')->name('eliminar.producto_combinados');

Route::get('panel/configuraciones/menu', 'MenuController@index')->name('index.menu');
Route::get('panel/configuraciones/menu/registrar', 'MenuController@create')->name('create.menu');
Route::post('panel/configuraciones/menu/registrar', 'MenuController@store')->name('store.menu');
Route::get('panel/configuraciones/menu/{id}', 'MenuController@edit')->name('edit.menu');
Route::patch('panel/configuraciones/menu/{id}', 'MenuController@update')->name('update.menu');
Route::delete('panel/configuraciones/menu/{id}', 'MenuController@destroy')->name('destroy.menu');

Route::get('panel/configuraciones/seccion_uno', 'SeccionUnoController@index')->name('index.seccion_uno');
Route::get('panel/configuraciones/seccion_uno/{id}', 'SeccionUnoController@edit')->name('edit.seccion_uno');
Route::patch('panel/configuraciones/seccion_uno/{id}', 'SeccionUnoController@update')->name('update.seccion_uno');

Route::get('panel/configuraciones/seccion_tres', 'SeccionTresController@index')->name('index.seccion_tres');
Route::get('panel/configuraciones/seccion_tres/{id}', 'SeccionTresController@edit')->name('edit.seccion_tres');
Route::patch('panel/configuraciones/seccion_tres/{id}', 'SeccionTresController@update')->name('update.seccion_tres');

Route::get('panel/configuraciones/faq', 'FaqController@index')->name('index.faq');
Route::get('panel/configuraciones/faq/registrar', 'FaqController@create')->name('create.faq');
Route::post('panel/configuraciones/faq/registrar', 'FaqController@store')->name('store.faq');
Route::get('panel/configuraciones/faq/{id}', 'FaqController@edit')->name('edit.faq');

Route::get('panel/ventas/pedidos', 'VentasController@index')->name('index.ventas');
Route::get('panel/ventas/pedidos/{id}', 'VentasController@detalle')->name('detalle.ventas');
Route::patch('panel/ventas/pedidos/{id}', 'VentasController@estado')->name('estado.ventas');

Route::get('panel/configuraciones/galeria', 'GaleriaController@index')->name('index.galeria');
Route::post('panel/configuraciones/galeria', 'GaleriaController@store')->name('store.galeria');
Route::delete('panel/configuraciones/galeria/{id}', 'GaleriaController@eliminar')->name('eliminar.galeria');

Route::get('panel/configuraciones/slider', 'SliderController@index')->name('index.slider');
Route::get('panel/configuraciones/slider/crear', 'SliderController@create')->name('create.slider');
Route::post('panel/configuraciones/slider/crear', 'SliderController@store')->name('store.slider');
Route::get('panel/configuraciones/slider/{id}', 'SliderController@edit')->name('edit.slider');
Route::patch('panel/configuraciones/slider/{id}', 'SliderController@update')->name('update.slider');
Route::delete('panel/configuraciones/slider/{id}', 'SliderController@eliminar')->name('eliminar.slider');

Route::get('panel/navegacion', 'NavController@index')->name('index.nav');
Route::get('panel/navegacion/crear', 'NavController@create')->name('create.nav');
Route::post('panel/navegacion/crear', 'NavController@store')->name('store.nav');
Route::get('panel/navegacion/{id}', 'NavController@edit')->name('edit.nav');
Route::patch('panel/navegacion/{id}', 'NavController@update')->name('update.nav');
Route::delete('panel/navegacion/{id}', 'NavController@destroy')->name('destroy.nav');

Route::get('panel/usuario', 'UsuarioController@index')->name('index.usuario');
Route::get('panel/usuario/crear', 'UsuarioController@create')->name('create.usuario');
Route::post('panel/usuario/crear', 'UsuarioController@store')->name('store.usuario');
Route::get('panel/usuario/{id}', 'UsuarioController@edit')->name('edit.usuario');
Route::patch('panel/usuario/{id}', 'UsuarioController@update')->name('update.usuario');
Route::delete('panel/usuario/{id}', 'UsuarioController@destroy')->name('destroy.usuario');

//rutas combinados

Route::get('panel/data/subproductos', 'SubproductoController@index')->name('admin.subproducto');
Route::get('panel/data/subproductos/registrar', 'SubproductoController@create')->name('registrar.subproducto');
Route::post('panel/data/subproductos/registrar', 'SubproductoController@store')->name('store.subproducto');
Route::delete('panel/data/subproductos/{subproducto_id}', 'SubproductoController@eliminar')->name('eliminar.subproducto');
Route::get('panel/data/subproductos/{id}/editar', 'SubproductoController@editar')->name('edit.subproducto');
Route::put('panel/data/subproductos/{id}', 'SubproductoController@actualizar')->name('actualizar.subproducto');


//TEST
Route::get('panel/configuraciones/combinado', 'CombinadoController@test')->name('index.combinado');
//Route::get('panel/configuraciones/combinado','CombinadoController@index')->name('index.combinado');
Route::get('panel/configuraciones/combinado/registrar', 'CombinadoController@test_create')->name('create.combinado');
//Route::get('panel/configuraciones/combinado/registrar','CombinadoController@create')->name('create.combinado');
Route::post('panel/configuraciones/combinado/registrar', 'CombinadoController@test_store')->name('store.combinado');
//Route::post('panel/configuraciones/combinado/registrar','CombinadoController@store')->name('store.combinado');
Route::get('panel/configuraciones/combinado/{combinado}/edit', 'CombinadoController@test_edit')->name('combinados.edit');
Route::delete('panel/configuraciones/combinado/{combinado}/subproductos/{subproducto}', 'CombinadoController@eliminarSubproducto')->name('combinados.eliminarSubproducto');
Route::post('panel/configuraciones/combinado/{combinado}/subproductos', 'CombinadoController@agregarSubproducto')->name('combinados.agregarSubproducto');
Route::post('panel/configuraciones/combinado/{combinado}/relacionar-subproducto', 'CombinadoController@relacionarSubproducto')->name('combinados.relacionarSubproducto');
Route::delete('panel/configuraciones/combinado/{combinado_id}', 'CombinadoController@eliminar')->name('combinados.eliminar');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de pasarela de pago
Route::post('/payments/pay', 'PaymentController@pay')->name('pay');
Route::get('/payments/approval', 'PaymentController@approval')->name('approval');
Route::get('/payments/cancelled', 'PaymentController@cancelled')->name('cancelled');
Route::post('/payments/confirm', 'PaymentController@confirmPayment')->name('confirmPayment');

Route::get('/horario', 'CarritoController@horario')->name('horario_confirm');
Route::post('/cuenta/hoy', 'CarritoController@enviar_Pedido')->name('enviar_pedido');
Route::get('/mostrar/hoy/{id}', 'CarritoController@mostrarHoy')->name('mostrar_hoy');

Route::get('/export-csv', 'UsuarioController@exportCsv')->name('export.csv');


Route::get(
    'test', function () {
        return view('test');
    }
);


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
