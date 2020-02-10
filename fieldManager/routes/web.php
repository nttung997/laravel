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

Route::get('/', function () {
    return view('welcome');
});
Route::get('api/customer', function () {
    $customer = App\Customer::all()->toJson();
    return $customer;
});
Route::get('api/customer/{name}', function ($name) {
    $customer = App\Customer::where('name','like','%'.$name.'%')->get()->toJson();
    return $customer;
});
Route::get('api/customer/{id}/invoice', function ($id) {
    $customer = App\Customer::find($id)->invoice->toJson();
    return $customer;
});
Route::get('api/distributor', function () {
    $distributor = App\Distributor::all()->toJson();
    return $distributor;
});
Route::get('api/field', function () {
    $field = App\Field::all()->toJson();
    return $field;
});
Route::get('api/invoice', function () {
    $invoice = App\Invoice::all()->toJson();
    return $invoice;
});
Route::get('api/invoiceproduct', function () {
    $invoiceproduct = App\InvoiceProduct::all()->toJson();
    return $invoiceproduct;
});
Route::get('api/minifield', function () {
    $minifield = App\MiniField::all()->toJson();
    return $minifield;
});
Route::get('api/minifieldinvoice', function () {
    $minifieldinvoice = App\MiniFieldInvoice::all()->toJson();
    return $minifieldinvoice;
});
Route::get('api/product', function () {
    $product = App\Product::all()->toJson();
    return $product;
});
