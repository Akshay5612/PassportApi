<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportController;

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

Route::get('/',[PassportController::class, 'index']);
Route::post('/update',[PassportController::class, 'updateData'])->name('update');
Route::post('/update-user-age', [PassportController::class, 'updateAge'])->name('update.user.age');
