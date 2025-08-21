<?php

use App\Http\Controllers\LoginController;
use App\Livewire\AkunSaya;
use App\Livewire\Cancel;
use App\Livewire\Cetak;
use App\Livewire\Delegation;
use App\Livewire\Edit;
use App\Livewire\Feedback;
use App\Livewire\FeedbackAdd;
use App\Livewire\Grafik;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('pembatalan', Cancel::class)->name('daftar.pembatalan');
    Route::get('pelimpahan', Delegation::class)->name('daftar.pelimpahan');
    Route::get('cetak/{jenis}/{id}', Cetak::class)->name('cetak');
    Route::get('edit/{jenis}/{id}', Edit::class)->name('edit');
    Route::get('kritiksaran', Feedback::class)->name('kritiksaran');
    Route::get('akunsaya', AkunSaya::class)->name('akunsaya');
});
Route::get('grafik', Grafik::class)->name('grafik');
Route::get('addkritiksaran', FeedbackAdd::class)->name('addkritiksaran');
