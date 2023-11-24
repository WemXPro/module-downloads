<?php
use Modules\Downloads\Controllers\DownloadsController;
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

// Publicly accessible route to view downloads
Route::get('/downloads', [DownloadsController::class, 'index'])->name('downloads.index');

// Routes under the 'downloads' prefix
Route::prefix('downloads')->group(function () {

    // Form to create a new download
    Route::get('/create', [DownloadsController::class, 'create'])->name('downloads.create');

    // Store a new download
    Route::post('/', [DownloadsController::class, 'store'])->name('downloads.store');

    // Download route
    Route::get('/{id}/download', [DownloadsController::class, 'download'])->name('downloads.download');



})->middleware(['web', 'auth']);
