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

Route::prefix('admin/downloads')->group(function () {
    Route::get('/', 'DownloadsController@index')->name('downloads.index');
    Route::get('create', 'DownloadsController@create')->name('downloads.create');
    Route::post('store', 'DownloadsController@store')->name('downloads.store');
    Route::get('download/{id}', 'DownloadsController@download')->name('downloads.download');
    Route::get('edit/{id}', 'DownloadsController@edit')->name('downloads.edit');
    Route::put('update/{id}', 'DownloadsController@update')->name('downloads.update');
    Route::delete('destroy/{id}', 'DownloadsController@destroy')->name('downloads.destroy');
});

Route::prefix('client')->group(function() {
    Route::get('downloads', 'ClientDownloadsController@index')->name('client.downloads');
    Route::get('downloads/{id}/download', 'ClientDownloadsController@download')->name('downloads.client.download');
});

    