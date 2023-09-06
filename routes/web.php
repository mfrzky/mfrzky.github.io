<?php

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

Route::get('/', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@check_login')->name('login.check_login');

Route::get('/purchase-orders', 'DashboardController@index')->name('purchase-orders.index');
Route::get('/surat-jalan', 'DashboardController@indexSuratJalan')->name('surat-jalan.index');
Route::get('/invoices', 'DashboardController@indexInvoices')->name('invoices.index');
Route::get('/dts', 'DashboardController@indexDts')->name('dts.index');
Route::get('/logout', 'DashboardController@logout')->name('logout');