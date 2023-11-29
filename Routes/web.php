<?php

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

Route::prefix('admin/downloads')->middleware('permission')->group(function () {
    Route::get('/', 'DownloadsController@index')->name('downloads.index');
    Route::get('create', 'DownloadsController@create')->name('downloads.create');
    Route::post('store', 'DownloadsController@store')->name('downloads.store');
    Route::get('download/{download}', 'DownloadsController@download')->name('downloads.download');
    Route::get('edit/{download}', 'DownloadsController@edit')->name('downloads.edit');
    Route::put('update/{download}', 'DownloadsController@update')->name('downloads.update');
    Route::delete('destroy/{download}', 'DownloadsController@destroy')->name('downloads.destroy');
});


Route::get('/downloads', 'ClientDownloadsController@index')->name('client.downloads');
Route::get('/downloads/{download}/download', 'ClientDownloadsController@download')->name('downloads.client.download');
