<?php

use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TacheController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('/taches', TacheController::class)->middleware('auth')->except(['show']);

Route::get('/terminees', [TacheController::class, 'tachesTerminees'])->middleware('auth')->name('taches.terminees');
Route::get('/en_cours', [TacheController::class, 'tachesEncours'])->middleware('auth')->name('taches.en_cours');
Route::get('/a_venir', [TacheController::class, 'tachesAVenir'])->middleware('auth')->name('taches.a_venir');

Route::put('/taches/{id}/finish', [TacheController::class, 'marqueToFinish'])->middleware('auth')->name('taches.marque.finish');
Route::put('/taches/{id}/begin', [TacheController::class, 'marqueToBegin'])->middleware('auth')->name('taches.marque.begin');

Route::get('/tasks-export', [ExportDataController::class, 'downloadView'])->name('export.view');
Route::get('/tasks-export/tache_pdf', [ExportDataController::class, 'exportTachePdf'])->name('export.tache.pdf');
//Route::get('/terminees', [TacheController::class, 'tachesTerminees'])->middleware('auth')->name('taches.terminees');


require __DIR__.'/auth.php';
