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

Route::group(['middleware' => 'auth.custom'], function () {
    // Route atau controller yang perlu otentikasi
    Route::get('/purchase-orders', 'PurchaseOrderController@index')->name('purchase-orders');
});

// ----------------LOGIN----------------
Route::get('/', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@check_login')->name('login.check_login');

// ----------------CHANGE PASSWORD----------------
Route::get('/change-password','LoginController@changePassword')->name('login.changePassword');
Route::post('/change-password-post','LoginController@postChangePassword')->name('login.postChangePassword');

// ADMIN
Route::get('/admin', 'AdminController@index')->name('admin-menu.index');
Route::post('/email-vendor', 'AdminController@changeEmailVendor')->name('email-vendor.changeEmailVendor');


// ----------------PURCHASE ORDERS----------------
Route::get('/purchase-orders', 'PurchaseOrdersController@index')->name('purchase-orders.index');
Route::get('/purchase-orders-id', 'PurchaseOrdersController@indexPoById')->name('purchase-orders.indexPoById');
Route::get('/purchase-orders-item-po', 'PurchaseOrdersController@indexItemPo')->name('purchase-orders-item-po.indexItemPo');
Route::get('/purchase-orders-item-sj', 'PurchaseOrdersController@indexItemSuratJalan')->name('purchase-orders-item-sj.indexItemSuratJalan');
Route::get('/purchase-orders-item-bpb', 'PurchaseOrdersController@indexItemBonPenerimaanBarang')->name('purchase-orders-item-bpb.indexItemBonPenerimaanBarang');
Route::get('/purchase-orders-item-brb', 'PurchaseOrdersController@indexItemBonReturBarang')->name('purchase-orders-item-brb.indexItemBonReturBarang');

// ----------------SURAT JALAN----------------
Route::get('/surat-jalan', 'SuratJalanController@indexSuratJalan')->name('surat-jalan.index');
Route::get('/surat-jalan-list-po', 'SuratJalanController@indexSuratJalanListPo')->name('surat-jalan.indexPo');
Route::get('/surat-jalan-item-sj', 'SuratJalanController@indexItemSuratJalan')->name('surat-jalan-item-sj.indexItemSuratJalan');
Route::get('/surat-jalan-item-bpb', 'SuratJalanController@indexItemBonPenerimaanBarang')->name('surat-jalan.indexItemBonPenerimaanBarang');

// Delete
Route::delete('/surat-jalan', 'SuratJalanController@deleteListSuratJalanById')->name('surat-jalan.deleteListSuratJalanById');
Route::delete('/surat-jalan-item', 'SuratJalanController@deleteItemSuratJalanById')->name('surat-jalan.deleteItemSuratJalanById');

// Edit
Route::post('/surat-jalan/edit', 'SuratJalanController@editListSuratJalanById')->name('surat-jalan.editListSuratJalanById');
Route::post('/surat-jalan-item/edit', 'SuratJalanController@editItemSuratJalanById')->name('surat-jalan.editItemSuratJalanById');
Route::get('/surat-jalan/get', 'SuratJalanController@getListSuratJalanById')->name('surat-jalan.getListSuratJalanById');
Route::get('/surat-jalan-item-edit/get', 'SuratJalanController@getDataItemById')->name('surat-jalan.getDataItemById');

// Add
Route::post('/surat-jalan/add', 'SuratJalanController@addListSuratJalan')->name('surat-jalan.addListSuratJalan');

// Add Item
Route::post('/surat-jalan-item/add', 'SuratJalanController@addItemSuratJalan')->name('surat-jalan.addItemSuratJalan');
Route::get('/surat-jalan-item/get', 'SuratJalanController@getItemSuratJalanById')->name('surat-jalan.getItemSuratJalanById');

// ----------------INVOICES----------------
Route::get('/invoices', 'InvoicesController@indexInvoices')->name('invoices.index');
Route::get('/invoices-item', 'InvoicesController@indexItemInvoices')->name('invoices.indexItemInvoices');
Route::get('/invoices-item-id', 'InvoicesController@indexRincianInvoices')->name('invoices.indexRincianInvoices');
Route::get('/invoices-daftar-surat-jalan', 'InvoicesController@indexDaftarSuratJalan')->name('invoices.indexDaftarSuratJalan');

// Delete
Route::delete('/invoices-item', 'InvoicesController@deleteItemInvoices')->name('invoices.deleteItemInvoices');
Route::delete('/invoices-list', 'InvoicesController@deleteListInvoices')->name('invoices.deleteListInvoices');

// Edit
Route::post('/invoices/edit', 'InvoicesController@editListInvoicesById')->name('invoices.editListInvoicesById');
Route::get('/invoices/get', 'InvoicesController@getListInvoicesById')->name('invoices.getListInvoicesById');

// Add
Route::post('/invoices-list', 'InvoicesController@addInvoiceList')->name('invoices.addInvoiceList');
Route::post('/invoices-item', 'InvoicesController@addInvoiceItem')->name('invoices.addInvoiceItem');

// ----------------DTS----------------
Route::get('/dts', 'DtsController@indexDts')->name('dts.index');
Route::get('/download/{filename}', 'DtsController@downloadFile')->name('dts.downloadFile');

// ----------------MANAGEMENT MATERIAL----------------
Route::get('/management-material', 'ManagementMaterialController@index')->name('management-material.index');
Route::get('/management-material/stock-code', 'ManagementMaterialController@indexStockCode')->name('management-material.indexStockCode');
Route::post('/management-material/stock-code/search', 'ManagementMaterialController@indexStockCodeSearch')->name('management-material.indexStockCodeSearch');

// Add
Route::post('/management-material/add', 'ManagementMaterialController@addManagementMaterial')->name('management-material.addManagementMaterial');

// ----------------LAPORAN----------------
Route::get('/laporan', 'LaporanController@index')->name('laporan.index');

// ----------------LOGOUT----------------
Route::get('/logout', 'PurchaseOrdersController@logout')->name('logout');

// ----------------PRINT----------------
Route::get('/prnpriview','PrintController@prnpriview')->name('print.prnpriview');
Route::get('/prnpriview/management-material','PrintController@prnpriviewManagementMaterial')->name('print.prnpriviewManagementMaterial');
Route::get('/prnpriview/laporan','PrintController@prnpriviewLaporan')->name('print.prnpriviewLaporan');

// ----------------SEND EMAIL----------------
Route::get('/send-email','SendEmailController@indexSuratJalan')->name('email.sendEmailSJ');

Route::get('/dbimage/{id}','PrintController@getImage')->name('purchase-orders-print.getImage');