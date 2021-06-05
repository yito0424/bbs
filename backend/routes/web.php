<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;

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
    return view('welcome');
});

Route::get('/dashboard', [ThreadController::class, 'index'])
        ->middleware(['auth'])->name('dashboard');

Route::get('/threads/{id}', [ThreadController::class, 'show'])
        ->middleware(['auth'])->name('thread.show');

require __DIR__.'/auth.php';
