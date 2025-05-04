<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleCompraController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SesionController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('Clientes', ClienteController::class);
Route::resource('Artistas', ArtistaController::class);
Route::resource('Reservas', ReservaController::class);
Route::resource('Productos', ProductoController::class);
Route::resource('Proveedores', ProveedorController::class);
Route::resource('Compras', CompraController::class);
Route::resource('DetallesCompras', DetalleCompraController::class);

Route::post('/chatbot/respond', [ChatbotController::class, 'respond'])->name('admin.chatbot.respond');
Route::get('/chatbot', function () {
    return view('admin.chatbot');
})->name('admin.chatbot');

Route::get('/reservas/rapida', [App\Http\Controllers\ReservaController::class, 'createRapida'])->name('Reservas.rapida');
Route::post('/reservas/rapida', [App\Http\Controllers\ReservaController::class, 'storeRapida'])->name('Reservas.storeRapida');
Route::get('/clientes/verificar', [App\Http\Controllers\ClienteController::class, 'verificarCliente'])->name('Clientes.verificar');
Route::get('/sesiones/calendario', [SesionController::class, 'calendario'])->name('sesiones.calendario');
Route::post('/sesiones', [SesionController::class, 'store'])->name('sesiones.store');
Route::get('/sesiones/crear', [SesionController::class, 'crear'])->name('sesiones.crear');