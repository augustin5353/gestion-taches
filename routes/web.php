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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('/taches', TacheController::class)->middleware('auth')->except(['show']);

Route::get('/taches/terminees', [TacheController::class, 'tachesTerminees'])->middleware('auth')->name('taches.terminees');
Route::get('/taches/en_cours', [TacheController::class, 'tachesEncours'])->middleware('auth')->name('taches.en_cours');
Route::get('/taches/a_venir', [TacheController::class, 'tachesAVenir'])->middleware('auth')->name('taches.a_venir');

Route::put('/taches/{id}/finish', [TacheController::class, 'marqueToFinish'])->middleware('auth')->name('taches.marque.finish');
Route::put('/taches/{id}/begin', [TacheController::class, 'marqueToBegin'])->middleware('auth')->name('taches.marque.begin');
Route::get('/taches/statistiques', [TacheController::class, 'statistiques'])->middleware('auth')->name('taches.statistiques');

Route::get('/tasks-export', [ExportDataController::class, 'downloadView'])->name('export.view');
Route::get('/tasks-export/tache_pdf', [ExportDataController::class, 'exportTachePdf'])->name('export.tache.pdf');
Route::get('/tasks-export/tache_excel', [ExportDataController::class, 'exportTacheExcel'])->name('export.tache.excel');
Route::post('/tasks-export', [ExportDataController::class, 'exportData'])->name('export.tache');
//Route::get('/terminees', [TacheController::class, 'tachesTerminees'])->middleware('auth')->name('taches.terminees');


require __DIR__.'/auth.php';
