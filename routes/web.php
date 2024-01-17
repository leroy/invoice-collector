<?php

use App\Livewire\Pages\Result;
use App\Livewire\Pages\Setup;
use App\Livewire\Pages\Process;
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

Route::get('/', Setup::class)->name('setup');

Route::get('/process', Process::class)->name('process');
Route::get('/result', Result::class)->name('result');
