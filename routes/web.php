<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('top');
})->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('posts', PostController::class)->only(['index']);
    // fullcalender
    Route::post('/schedule-add', [PostController::class, 'scheduleAdd'])->name('schedule-add');
    Route::post('/schedule-get', [PostController::class, 'scheduleGet'])->name('schedule-get');
    Route::post('/schedule-edit', [PostController::class, 'scheduleEdit'])->name('schedule-edit');
    Route::post('/schedule-delete', [PostController::class, 'scheduleDelete'])->name('schedule-delete');
    Route::post('/schedule-drop', [PostController::class, 'scheduleDrop'])->name('schedule-drop');
    Route::post('/schedule-resize', [PostController::class, 'scheduleResize'])->name('schedule-resize');
});
require __DIR__.'/auth.php';
