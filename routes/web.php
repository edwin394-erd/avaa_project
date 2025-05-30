<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\PerfilController;


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
Route::get('/test', function () {
    return view('test');
});
Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::post('/register',[RegisterController::class, 'store']);


Route::post('/Logout',[LogoutController::class, 'store'])->name('logout');
Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);

Route::post('/actividades/crear',[StatController::class, 'store'])->name('stat.store');
Route::post('/actividades/{stat}/anular', [StatController::class, 'anular'])->name('stat.anular');
Route::post('/actividades/{stat}/restaurar', [StatController::class, 'restaurar'])->name('stat.restaurar');

Route::post('/actividades/{stat}/aprobar', [StatController::class, 'aprobar'])->name('stat.aprobar');
Route::post('/actividades/{stat}/rechazar', [StatController::class, 'rechazar'])->name('stat.rechazar');

Route::get('/tabla-actividades',[StatController::class, 'index'])->name('stats.index');
Route::get('/actividades/{modalidad}/', [StatController::class, 'modalidadindex'])->name('modalidad.index');

Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');

Route::post('/evidencias',[EvidenciaController::class, 'store'])->name('evidencia.store');

Route::get('/Perfil/datos-personales',[PerfilController::class, 'datosindex'])->name('datos.index');

Route::get('/Perfil/configuracion-usuario',[PerfilController::class, 'configindex'])->name('configuser.index');
Route::post('/Perfil/configuracion-usuario', [PerfilController::class, 'update'])->name('configuser.update');

Route::post('/notificaciones/marcar-leidas', function () {
    auth()->user()->notifications()->where('leida', false)->update(['leida' => true]);
    return response()->json(['ok' => true]);
})->name('notificaciones.marcarLeidas')->middleware('auth');









