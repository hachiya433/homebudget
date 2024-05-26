<?php

use App\Http\Controllers\HomebudgetController;
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
    return view('homebudget.index');
});
Route::get('/', [HomebudgetController::class, 'index'])->name('index');
Route::post('/post', [HomebudgetController::class, 'store'])->name('store');
Route::get('/edit/{id}', [HomebudgetController::class, 'edit'])->name('homebudget.edit');
Route::put('/update', [HomebudgetController::class, 'update'])->name('homebudget.update');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
