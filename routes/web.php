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

Route::get('/', [TacheController::class, 'home'])->middleware('auth')->name('taches.home');

Route::get('/dashboard', [TacheController::class, 'dashoard'])->middleware('auth')->name('dashboard'); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('/taches', TacheController::class)->middleware('auth')->except(['show']);

Route::prefix('/taches')->name('taches.')->middleware('auth')->group(function(){

    Route::get('terminees', [TacheController::class, 'tachesTerminees'])->name('terminees');
    Route::get('en_cours', [TacheController::class, 'tachesEncours'])->name('en_cours');
    Route::get('a_venir', [TacheController::class, 'tachesAVenir'])->name('a_venir');

    Route::get('notifiable/{tache}', [TacheController::class, 'setNotifiableColumn'])->name('notifiable');

    Route::put('{id}/finish', [TacheController::class, 'marqueToFinish'])->name('marque.finish');
    Route::put('{id}/begin', [TacheController::class, 'marqueToBegin'])->name('marque.begin');
    Route::get('statistiques', [TacheController::class, 'statistiques'])->name('statistiques');    

    Route::post('/tasks-export', [ExportDataController::class, 'exportData'])->name('export.tache');
    Route::get('/tasks-export', [ExportDataController::class, 'downloadView'])->name('export.view');

   
});



//export route avant la methode exportData
/* 
Route::get('/tasks-export/tache_pdf', [ExportDataController::class, 'exportTachePdf'])->name('export.tache.pdf');
Route::get('/tasks-export/tache_excel', [ExportDataController::class, 'exportTacheExcel'])->name('export.tache.excel'); */


//Route::get('/terminees', [TacheController::class, 'tachesTerminees'])->middleware('auth')->name('taches.terminees');


require __DIR__.'/auth.php';
