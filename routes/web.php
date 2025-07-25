<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecuperarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ImagenController;
// use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\ResetPasswordController;






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
Route::get('/recuperar-contrasena',[RecuperarController::class, 'index'])->name('recuperar.contrasena');
Route::post('/recuperar-contrasena', [RecuperarController::class, 'store'])->name('recuperar.contrasena.enviar');

Route::post('/actividades/crear',[StatController::class, 'store'])->name('stat.store');
Route::post('/actividades/{stat}/anular', [StatController::class, 'anular'])->name('stat.anular');
Route::post('/actividades/{stat}/restaurar', [StatController::class, 'restaurar'])->name('stat.restaurar');
Route::put('/actividades/{stat}/editar', [StatController::class, 'update'])->name('stats.update');


Route::post('/actividades/{stat}/aprobar', [StatController::class, 'aprobar'])->name('stat.aprobar');
Route::post('/actividades/{stat}/rechazar', [StatController::class, 'rechazar'])->name('stat.rechazar');

Route::get('/tabla-actividades',[StatController::class, 'index'])->name('stats.index');
Route::get('/Actividades/{modalidad}/', [StatController::class, 'modalidadindex'])->name('modalidad.index');

Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');

// Route::post('/evidencias',[EvidenciaController::class, 'store'])->name('evidencia.store');

Route::get('/Perfil/datos-personales',[PerfilController::class, 'datosindex'])->name('datos.index');

Route::get('/Perfil/configuracion-usuario',[PerfilController::class, 'configindex'])->name('configuser.index');
Route::post('/Perfil/configuracion-usuario', [PerfilController::class, 'update'])->name('configuser.update');
Route::post('/Perfil/datos-usuario', [PerfilController::class, 'datosuserupdate'])->name('datosuser.update');


Route::get('/Usuarios',[UserController::class, 'index'])->name('users.index');
Route::post('/Usuarios',[UserController::class, 'store'])->name('users.store');
Route::put('/Usuarios/{id}', [UserController::class, 'update'])->name('users.update');
Route::post('/usuarios/{id}/activar', [UserController::class, 'activar'])->name('users.activar');
Route::post('/usuarios/{id}/desactivar', [UserController::class, 'desactivar'])->name('users.desactivar');
Route::get('/Usuarios/Becario/{id}', [UserController::class, 'showbecario'])->middleware('auth')->name('users.showbecario');

Route::get('/Eventos/all', [EventController::class, 'allEvents'])->middleware('auth')->name('events.all');
Route::get('/Eventos',[EventController::class, 'index'])->name('activities.index');
Route::post('/Eventos', [EventController::class, 'store'])->name('activities.store');
Route::post('/Eventos/{id}/cancelar', [EventController::class, 'cancelar'])->name('activities.cancelar');
Route::post('/Eventos/{id}/restaurar', [EventController::class, 'restaurar'])->name('activities.restaurar');
Route::put('/Eventos/{id}', [EventController::class, 'update'])->name('activities.update');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/notificaciones/json', function () {
    $notificaciones = auth()->user()
        ->notifications()
        ->latest()
        ->take(10)
        ->get(['id', 'titulo', 'mensaje', 'leida', 'created_at', 'stat_id']);
    return response()->json($notificaciones);
})->middleware('auth');

Route::post('/notificaciones/marcar-leidas', function () {
    auth()->user()->notifications()->where('leida', false)->update(['leida' => true]);
    return response()->json(['ok' => true]);
})->name('notificaciones.marcarLeidas')->middleware('auth');

Route::get('/stats/all', [StatController::class, 'allStats'])->middleware('auth')->name('stats.all');
Route::get('/stats/ir-a-stat/{statId}', [StatController::class, 'irAStat'])->name('stats.irAStat');
Route::get('/stats/{modalidad}', [StatController::class, 'modalidadindex'])->name('stats.modalidadindex');
Route::get('/stats/all/{modalidad}', [StatController::class, 'allStatsmodalidad'])->middleware('auth')->name('stats.all.modalidad');













