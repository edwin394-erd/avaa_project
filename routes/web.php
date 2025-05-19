<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\EvidenciaController;


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
})->name('test');

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::post('/register',[RegisterController::class, 'store']);


Route::post('/Logout',[LogoutController::class, 'store'])->name('logout');
Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);

Route::get('/agregar-actividad',[StatController::class, 'create'])->name('stat.create');
Route::post('/agregar-actividad',[StatController::class, 'store'])->name('stat.store');

Route::get('/tabla-actividades',[StatController::class, 'index'])->name('stats.index');

Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');

Route::post('/Evidencias',[EvidenciaController::class, 'store'])->name('evidencia.store');







