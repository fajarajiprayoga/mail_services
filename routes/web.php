<?php

use App\Http\Controllers\SPLController;
use App\Jobs\BroadcastSPLValueJob;
use App\Mail\BroadcastSPLValue;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
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
    return view('welcome');
});

Route::get('/spl/broadcast-spl-value', [SPLController::class, 'broadcastSPLValue'])->name('broadcastSPLValue');