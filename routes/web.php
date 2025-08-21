<?php

use App\Http\Controllers\CetakController;
use App\Livewire\Cancel;
use App\Livewire\Cetak;
use App\Livewire\Delegation;
use App\Livewire\Edit;
use App\Livewire\Home;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Home::class)->name('home');
Route::get('login', Login::class)->name('login');
Route::get('pembatalan', Cancel::class)->name('daftar.pembatalan');
Route::get('pelimpahan', Delegation::class)->name('daftar.pelimpahan');
Route::get('cetak/{jenis}/{id}', Cetak::class)->name('cetak');
Route::get('edit/{jenis}/{id}', Edit::class)->name('edit');
