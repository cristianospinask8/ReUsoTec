<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\RoleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    } else {
        return Inertia::render('Welcome', [
            
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            
    
        ]);
    }
});

Route::get('/about', fn () => Inertia::render('About'))->name('about');
Route::get('/conocenos', fn () => Inertia::render('Conocenos'))->name('conocenos');

Route::get('/home', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});


Route::post('registro', [RegistroController::class, 'create'])->name('registro');
Route::get('/registrados', [RegistroController::class, 'index'])->name('registrados.index');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registrado', [RegistroController::class, 'edit'])->name('registrados.edit');
    Route::patch('/registrado', [RegistroController::class, 'update'])->name('registrados.update');
    
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class)->middleware('auth');
    Route::resource('roles', RoleController::class);
    
});



require __DIR__.'/auth.php';
