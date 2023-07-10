<?php

use App\Http\Controllers\LoginController;
use App\Models\usuarios;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductoController::class,'mostrarCarrusel'])->name('/');

Route::get('/productos', [ProductoController::class,'mostrarCatalogo'])->name('productos');



Route::get('/mostrarImagen/{url}', [ProductoController::class,'mostrarImagen']);



Route::get('/detallesAuto/{id}', [ProductoController::class,'detallesAuto'])->name('detallesAuto');

Route::get('/login', function () {return view('login');})->name('login')->middleware('guest');
Route::get('/registro', function () {return view('registro');})->name('registro');
Route::get('/admin', function () {return view('admin');})->name('admin');
Route::get('/pago', function () {return view('pago');})->name('pago');


 

Route::post('/registrarCliente', [RegistroController::class,'registrarCliente'])->name('registrarCliente');
Route::post('/inicioSesion', [LoginController::class,'inicioSesion'])->name('inicioSesion');
Route::post('/cerrarSesion', [LoginController::class,'cerrarSesion'])->name('cerrarSesion');
Route::get('/compraUsuario', [CompraController::class,'compraUsuario'])->name('compraUsuario');
Route::get('/compraUsuarioPago', [CompraController::class,'compraUsuarioPago'])->name('compraUsuarioPago');


Route::post('/carritoCompra', [CompraController::class,'carritoCompra'])->name('carritoCompra');
Route::post('/actualizarCantidad', [CompraController::class, 'actualizarCantidad'])->name('actualizarCantidad');



Route::delete('/carrito/{id}', [CompraController::class, 'eliminarProducto'])->name('carrito.eliminar');

Route::get('/carrito/cantidad', 'CompraController@getCantidadProductosCarrito')->name('carrito.cantidad');
Route::post('/actualizarTotal', [CompraController::class, 'actualizarTotal'])->name('compra.actualizarTotal');


// Ruta para crear el pago
Route::get('/paypal/pay', [PagoController::class, 'createPayment'])->name('paypal.create-payment');

// Ruta para ejecutar el pago
Route::get('/paypal/status', [PagoController::class, 'executePayment'])->name('paypal.status');
Route::get('/pago', [PagoController::class, 'compraUsuario'])->name('pago');



Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/create',[AdminController::class,'create']);
Route::get('/update/{id}', [AdminController::class, 'showUpdateForm'])->name('update.form');
Route::put('/update/{id}', [AdminController::class, 'update'])->name('update');
Route::delete('/productos/{id}', [AdminController::class, 'eliminar'])->name('eliminar');



