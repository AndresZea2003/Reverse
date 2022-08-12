<?php

use App\Http\Controllers\PaymentsController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome')->name('welcome');

Route::resource('payment', PaymentsController::class);

//Route::view('/import', 'import')->name('import');

Route::post('/import-auth', [PaymentsController::class, 'processAuth'])->name('payment.import.auth');

Route::post('/import', [PaymentsController::class, 'import'])->name('payment.import');

Route::post('/reverse', [PaymentsController::class, 'reverse'])->name('payment.reverse');

Route::get('/export', [PaymentsController::class, 'export'])->name('payment.export');
