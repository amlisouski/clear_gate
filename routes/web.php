<?php

use App\Http\Controllers\TasksController;
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

Route::redirect('/', 'dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::resource('tasks', TasksController::class)->except(['show'])->whereNumber('task')->names('admin.tasks');
	Route::controller(TasksController::class)->group(function () {
		Route::patch('tasks/{task}/complete', 'complete')->whereNumber('task')->name('admin.tasks.complete');
	});
});

require __DIR__ . '/auth.php';
