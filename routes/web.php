<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/**
 * Default Authentication Routes
 */
Auth::routes();

/**
 * Home page
 */
Route::get('/', 'HomeController@index')->name('home');

/**
 * HOA Routes
 */
Route::prefix('hoa')->group(function () {

    Route::get('/', 'HoaController@index')->name('hoa.index');

    Route::post('/create', 'HoaController@create')->name('hoa.create');

    Route::get('/{id}/delete', 'HoaController@delete')->name('hoa.delete');

    Route::get('/{id}/manage', 'HoaController@manage')->name('hoa.manage');

    /**
     * HOA Admin pages for backend settings, like integrations
     */
    Route::prefix('/{id}/admin')->group(function () {

        Route::get('/quickbooks', 'QuickbooksController@index')->name('quickbooks.index');

        Route::post('/quickbooks/authorize', 'QuickbooksController@authorizeAccess')->name('quickbooks.authorize');
    });

    Route::get('/quickbooks/oauth/return', 'QuickbooksController@acceptCode')->name('quickbooks.return');
});

/**
 * Property Routes
 */
Route::prefix('properties')->group(function () {

    Route::get('/', 'PropertyController@index')->name('property.index');

    Route::post('/create', 'PropertyController@create')->name('property.create');

    Route::get('/{id}/delete', 'PropertyController@delete')->name('property.delete');

    Route::get('/{id}/manage', 'PropertyController@manage')->name('property.manage');

});

Route::post('/owner/create', 'OwnerController@add')->name('owner.create');

/**
 * Owner Routes
 */
Route::prefix('owners')->group(function () {

    Route::get('/', 'OwnerController@index')->name('owner.index');



    Route::get('/{id}/delete', 'OwnerController@delete')->name('owner.delete');

    Route::get('/{id}/manage', 'OwnerController@manage')->name('owner.manage');

    Route::post('/address/create', 'OwnerController@createAddress')->name('owner.address.create');

    Route::get('/{id}/addresses', 'OwnerController@listAddresses')->name('owner.addresses.list');

});

/**
 * Ticket Routes
 */
Route::prefix('tickets')->group(function () {

    Route::get('/', 'TicketController@index')->name('ticket.index');

    Route::post('/create', 'TicketController@create')->name('ticket.create');

    Route::get('/{id}/delete', 'TicketController@delete')->name('ticket.delete');

    Route::get('/{id}/manage', 'TicketController@manage')->name('ticket.manage');

    Route::post('/note/create', 'TicketController@createNote')->name('ticket.note.create');

    Route::get('/{id}/notes', 'TicketController@listNotes')->name('ticket.notes.list');
});

Route::prefix('compliance')->group(function () {

    Route::get('/', 'ComplianceController@index')->name('compliance.index');
});

/**
 * Location Routes
 */
Route::get('/location', 'LocationController@show');

Route::get('/quickbooks', 'QuickBooksController@index');

