<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Auth\Events\Verified;
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
// Route::get('/register',[LoginController::class, "register"])->name('studentReg');
// Route::get('/login',[LoginController::class, "login"])->name('studentLog');
// Route::get('/register',[LoginController::class, "register"])->name('login.register');
// Route::prefix('/home')->group(function(){
//     Route::get('/',[LoginController::class, "view"])->name('login.view');
//     Route::post('/logincheck',[LoginController::class, "login"])->name('login.check');
//     Route::post('/register',[LoginController::class, "register"])->name('login.register');
// });
// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


Route::get('/',[LoginController::class, "login"])->name('login');
Route::get('/register',[LoginController::class, "register"])->name('studentReg');
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::prefix('/dashboard')->group(function (){
    Route::get('/',[StudentController::class, "view"])->middleware(['auth', 'verified'])->name('show');
    Route::get('/list',[StudentController::class, "list"])->name('student.list');
    Route::post('/store', [StudentController::class, 'store'])->name('student.store');
    Route::get('/{task_id}/status', [StudentController::class, 'status'])->name('student.status');
    Route::delete('/{task_id}/delete', [StudentController::class, 'delete'])->name('student.delete');
    Route::get('/{task_id}/get', [StudentController::class, 'get'])->name('student.get');
    Route::get('/{task_id,image_id}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::post('/{task_id}/update', [StudentController::class, 'update'])->name('student.update');
});

require __DIR__.'/auth.php';
