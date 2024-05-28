<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactController;

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


Route::get('/register', [AdminRegistrationController::class, 'register']);
Route::post('/admin/store', [AdminRegistrationController::class, 'store'])->name('admin.register');
Route::get('/login', [AdminRegistrationController::class, 'login'])->name('admin.getdata');
Route::post('/admin/loginverify', [AdminRegistrationController::class, 'loginverify'])->name('admin.login');


Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contact}/update', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contact}/delete', [ContactController::class, 'destroy'])->name('contacts.delete');