<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\VendorInvoice;
use App\Http\Controllers\GstBillController;

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


Route::get("/",[AppController::class,'index'])->name('dashboard');
Route::get("/add-party",[PartyController::class,'addParty'])->name('add-party');
Route::post("/create-party",[PartyController::class,'createParty'])->name('create-party');
Route::get('/manage-parties', [PartyController::class,'index'])->name('manage-parties');
Route::get("/edit-party/{id}",[PartyController::class,'editParty'])->name('edit-party');
Route::put("/update-party",[PartyController::class,'updateParty'])->name('update-party');
Route::delete("/delete-party/{id}",[PartyController::class,'deleteParty'])->name('delete-party');

// GST bill routes
Route::get('/add-gst-bill', [GstBillController::class,'addGstBill'])->name('add-gst-bill');
Route::get('/manage-gst-bills', [GstBillController::class,'index'])->name('manage-gst-bills');
Route::get('/print-gst-bill/{id}', [GstBillController::class,'print'])->name('print-gst-bill');
Route::post("/create-gst-bill",[GstBillController::class,'createGstBill'])->name('create-gst-bill');
Route::get("/delete-gst-bill/{id}",[GstBillController::class,'deleteGstBill'])->name('delete-gst-bill');



//Vendor-invoice
Route::resource("/vendor-invoice",VendorInvoice::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

