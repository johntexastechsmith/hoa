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

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Home page
 */
Route::get('/', 'HoaController@index')->name('hoa.index');

/**
 * HOA Routes
 */
Route::prefix('hoa')->group(function () {

    Route::get('/', 'HoaController@index')->name('hoa.index');

    Route::post('/create', 'HoaController@create')->name('hoa.create');

    Route::get('/delete/{id}', 'HoaController@delete')->name('hoa.delete');

    Route::get('/manage/{id}', 'HoaController@manage')->name('hoa.manage');

});

/**
 * Property Routes
 */
Route::prefix('properties')->group(function () {

    Route::get('/', 'PropertyController@index')->name('property.index');

    Route::post('/create', 'PropertyController@create')->name('property.create');

    Route::get('/delete/{id}', 'PropertyController@delete')->name('property.delete');

    Route::get('/manage/{id}', 'PropertyController@manage')->name('property.manage');

});

/**
 * Ticket Routes
 */
Route::prefix('tickets')->group(function () {

    Route::get('/', 'TicketController@index')->name('ticket.index');

    Route::post('/create', 'TicketController@create')->name('ticket.create');

    Route::get('/delete/{id}', 'TicketController@delete')->name('ticket.delete');

    Route::get('/manage/{id}', 'TicketController@manage')->name('ticket.manage');

    Route::post('/note/create', 'TicketController@createNote')->name('ticket.note.create');

    Route::get('/{id}/notes', 'TicketController@listNotes')->name('ticket.notes.list');
});

/**
 * Location Routes
 */
Route::get('/location', 'LocationController@show');

