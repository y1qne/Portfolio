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

Route::get('/','App\Http\Controllers\IndexController@showIndex')->name('home');
Route::get('/home','App\Http\Controllers\IndexController@showIndex');

Route::get('/register','App\Http\Controllers\IndexController@showRegister')->name('register')->middleware('guest');

// register
Route::post('/registered', 'App\Http\Controllers\UserController@store')->name('save');
Route::get('/done', 'App\Http\Controllers\UserController@done')->name('done');

Route::get('/confirmation', 'App\Http\Controllers\ConfirmationController@confirm')->name('confirmation');

// login
Route::get('/login', 'App\Http\Controllers\LoginController@showLogin')->name('login')->middleware('guest');
Route::post('/logged', 'App\Http\Controllers\LoginController@connect')->name('logged');

Route::get('/send_email_form', function () {
    return view('send_email_form');
})->name('send_email_form')->middleware('guest');

Route::post('/send_email', 'App\Http\Controllers\LoginController@sendEmail')->name('send_email')->middleware('guest');

Route::get('/logout', 'App\Http\Controllers\LoginController@deconnect')->name('logout')->middleware('auth');

Route::post('/disable', 'App\Http\Controllers\UserController@disable')->name('disable')->middleware('auth');


//profil
Route::get('/profil', 'App\Http\Controllers\ProfilController@showProfil')->name('profil')->middleware('auth');
Route::get('/edit_profil', 'App\Http\Controllers\ProfilController@showEdit')->name('edit_profil')->middleware('auth');
Route::post('/save_edit_profil', 'App\Http\Controllers\ProfilController@update')->name('save_edit_profil')->middleware('auth');

//annonces
Route::get('/annonces', 'App\Http\Controllers\AnnonceController@showAnnonces')->name('annonces')->middleware('auth');
Route::get('/mesannonces', 'App\Http\Controllers\AnnonceController@showMyAnnonces')->name('mesannonces')->middleware('auth');
Route::get('/poster', 'App\Http\Controllers\AnnonceController@showAnnonce')->name('poster')->middleware('auth');
Route::post('/upload', 'App\Http\Controllers\AnnonceController@uploadAnnonce')->name('upload')->middleware('auth');

// image
Route::get('/images/{filename}', 'App\Http\Controllers\ImageController@getImage')->name('image')->middleware('auth');

// modif annonces
Route::get('/modifier_annonce', 'App\Http\Controllers\AnnonceController@editAnnonceForm')->name('edit_annonce_form')->middleware('auth');
Route::post('/modifier_annonce', 'App\Http\Controllers\AnnonceController@editAnnonce')->name('edit_annonce')->middleware('auth');
Route::get('/supprimer', 'App\Http\Controllers\AnnonceController@deleteAnnonce')->name('supprimer_annonce')->middleware('auth');

// search
Route::post('/search', 'App\Http\Controllers\AnnonceController@searchAnnonces')->name('search')->middleware('auth');

//messagerie
Route::get('/messagerie', 'App\Http\Controllers\MessageController@showMessages')->name('messagerie')->middleware('auth');
Route::get('/envois', 'App\Http\Controllers\MessageController@showSent')->name('envois')->middleware('auth');
Route::get('/contacter/{annonce_id}/{receiver_id}', 'App\Http\Controllers\MessageController@showMessageForm')
    ->name('contacter')
    ->middleware('auth');
Route::post('/send_message', 'App\Http\Controllers\MessageController@sendMessage')->name('send_message')->middleware('auth');
Route::post('/response/{annonce_id}/{sender_id}', 'App\Http\Controllers\MessageController@sendMessage')->name('response')->middleware('auth');
