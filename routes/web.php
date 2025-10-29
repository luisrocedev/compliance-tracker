
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Redirección explícita para /home (post-login)
Route::get('/home', function () {
    return redirect('/dashboard');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NormativaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\AuditoriaController;

Route::middleware(['auth', 'rol:admin,manager,viewer', 'auditoria'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('normativas', NormativaController::class);
    Route::resource('documentos', DocumentoController::class);
    Route::resource('alertas', AlertaController::class);
    Route::resource('auditoria', AuditoriaController::class)->middleware('rol:admin');
});
