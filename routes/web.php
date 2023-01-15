<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowerAppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DisplayDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

//common routes naming
//index - show all data
//show - show one data/single data
//create - show a form to add a new data
//store - store a data
//edit - show form to edit a data
//update - update a data
//destroy - delete a data

Route::get('/', function () {
    return view('landpage.index');
});

//public users routes

//show all books to public user
Route::get('/catalog', [BooksController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
//show a specific book to a user
Route::get('/catalog/book/{id}', [BooksController::class, 'show'])->middleware(['auth', 'verified'])->name('book.view');

//cart routes for public user
Route::get('/catalog/cart', [CartController::class, 'index'])->middleware(['auth', 'verified'])->name('cart.view');
Route::post('/catalog/cart/store', [CartController::class, 'store'])->middleware(['auth', 'verified'])->name('cart.store');
Route::post('/catalog/cart/remove', [CartController::class, 'remove'])->middleware(['auth', 'verified'])->name('cart.remove');

//borrower application routes
Route::get('/borrower/application', [BorrowerAppController::class, 'create'])->middleware(['auth', 'verified'])->name('borrower.app');
Route::post('/borrower/application', [BorrowerAppController::class, 'store'])->middleware(['auth', 'verified'])->name('borrower.store');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// // useless routes
// // Just to demo sidebar dropdown links active states.
// Route::get('/buttons/text', function () {
//     return view('buttons-showcase.text');
// })->middleware(['auth'])->name('buttons.text');

// Route::get('/buttons/icon', function () {
//     return view('buttons-showcase.icon');
// })->middleware(['auth'])->name('buttons.icon');

// Route::get('/buttons/text-icon', function () {
//     return view('buttons-showcase.text-icon');
// })->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
