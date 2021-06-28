<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProjectController;




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

Route::get('/scanner', function () {
    return view('scanner');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('qr', QrController::class);
Route::get('qr-print/{id}', [QrController::class, 'print'])->name('qr.print');

Route::prefix('projects')->group(function () {
    Route::get('apiwithoutkey', [ProjectController::class, 'apiWithoutKey'])->name('apiWithoutKey');
    Route::get('apiwithkey', [ProjectController::class, 'apiWithKey'])->name('apiWithKey');
});


Route::resource('projects', ProjectController::class);
