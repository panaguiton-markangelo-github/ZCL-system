<?php

use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowerAppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DisplayDataController;
use App\Http\Controllers\HLibrarianController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LibrarianProfileController;
use App\Http\Controllers\LibrariansController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Events;
use Illuminate\Http\Request;

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

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/fetch/events', [LandingPageController::class, 'fetchEvents'])->name('fetch_events');

// start public users routes:

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

//Borrower Book Requests routes
Route::get('/book/request', [BookRequestController::class, 'create'])->middleware(['auth', 'verified'])->name('book_req.view');
Route::post('/book/request', [BookRequestController::class, 'store'])->middleware(['auth', 'verified'])->name('book_req.store');

// end public users routes:

//--------------------------------------------------

//librarians routes: Head librarian

Route::get('/head_librarian/dashboard', [HLibrarianController::class, 'home'])->middleware('auth:librarians')->name('head_librarian.dashboard');

//librarians module routes
Route::get('/head_librarian/librarians', [HLibrarianController::class, 'index'])->middleware('auth:librarians')->name('librarians.view');

Route::post('/head_librarian/add/librarian', [HLibrarianController::class, 'store'])->middleware('auth:librarians')->name('librarians.store');

Route::get('/head_librarian/edit/librarian/{id}', [HLibrarianController::class, 'edit'])->middleware('auth:librarians')->name('librarians.edit');

Route::put('/head_librarian/update/librarian/{id}', [HLibrarianController::class, 'update'])->middleware('auth:librarians')->name('librarians.update');

Route::delete('/head_librarian/delete/librarian/{id}', [HLibrarianController::class, 'destroy'])->middleware('auth:librarians')->name('librarians.delete');
//end of librarians module routes


//announcements module routes
Route::get('/head_librarian/announcements', [HLibrarianController::class, 'indexAnnounce'])->middleware('auth:librarians')->name('head_librarian.view.announcements');

Route::post('/head_librarian/add/announcement', [HLibrarianController::class, 'storeAnnounce'])->middleware('auth:librarians')->name('announce.store');

Route::get('/head_librarian/edit/announcement/{id}', [HLibrarianController::class, 'editAnnounce'])->middleware('auth:librarians')->name('announce.edit');

Route::put('/head_librarian/update/announcement/{id}', [HLibrarianController::class, 'updateAnnounce'])->middleware('auth:librarians')->name('announce.update');

Route::delete('/head_librarian/delete/announcement/{id}', [HLibrarianController::class, 'destroyAnnounce'])->middleware('auth:librarians')->name('announce.delete');
//end of announcements module routes

//events module routes
Route::get('/head_librarian/events', [HLibrarianController::class, 'indexEvents'])->middleware('auth:librarians')->name('head_librarian.view.events');

Route::post('/head_librarian/add/event', [HLibrarianController::class, 'storeEvents'])->middleware('auth:librarians')->name('events.store');

// Route::get('/head_librarian/edit/event/{id}', [HLibrarianController::class, 'editEvents'])->middleware('auth:librarians')->name('events.edit');

Route::post('/head_librarian/update/event', [HLibrarianController::class, 'updateEvents'])->middleware('auth:librarians')->name('events.update');

Route::post('/head_librarian/delete/event', [HLibrarianController::class, 'destroyEvents'])->middleware('auth:librarians')->name('events.delete');
//end of events module routes

//end of head librarian routes


//-------------------------------------------------

//next is to display announcements on the landing page, and to create the review by users module.

//librarians routes: Borrow librarian


Route::get('/borrow_librarian/dashboard', function(){
    return view('borrowing_librarian.dashboard_borrowing_librarian');
})->middleware('auth:librarians')->name('borrowing_librarian.dashboard');


//end of borrowing librarian routes



//----------------------------------------------


//librarians routes: Catalog librarian

Route::get('/catalog_librarian/dashboard', function(){
    return view('catalog_librarian.dashboard_catalog_librarian');
})->middleware('auth:librarians')->name('catalog_librarian.dashboard');


//end of catalog librarian routes





//mark notification as read
Route::get('/markAsRead/{id}', function($id){

	$userUnreadNotification = auth()->user()->unreadNotifications->where('id', $id)->first();
    //dd($userUnreadNotification);

    if($userUnreadNotification){
        $userUnreadNotification->markAsRead();
    }

	return redirect()->back();

})->name('mark');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:librarians')->group(function () {
    Route::get('/librarian/profile', [LibrarianProfileController::class, 'edit'])->name('librarian.profile.edit');
    Route::patch('/librarian/profile', [LibrarianProfileController::class, 'update'])->name('librarian.profile.update');
    Route::delete('/librarian/profile', [LibrarianProfileController::class, 'destroy'])->name('librarian.profile.destroy');
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
require __DIR__ . '/libauth.php';
