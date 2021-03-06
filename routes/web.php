<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursController;

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

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('cours', [CoursController::class, 'index'])->name('cours.index');

    Route::post('cours', [CoursController::class, 'store'])->name('cours.store');

    Route::get('cours/{id}', [CoursController::class, 'show'])->name('cours.show');

    Route::post('toggleProgress', [CoursController::class, 'toggleProgress'])->name('cours.toggle');

    Route::get('cours/edit/{id}', [CoursController::class, 'edit'])->name('cours.edit');

    Route::patch('cours/{id}', [CoursController::class, 'update'])->name('cours.update');

});

