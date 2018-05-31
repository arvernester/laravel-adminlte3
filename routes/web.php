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

Route::redirect('/', '/dashboard');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::redirect('/home', '/dashboard')->name('home');

Route::get('dashboard', 'DashboardController')->name('dashboard');

Route::group(['prefix' => 'pages', 'as' => 'pages.'], function(){
    Route::view('general', 'pages.general', ['title' => __('General')])->name('general');
    Route::view('button', 'pages.button', ['title' => __('Buttons')])->name('button');
    Route::view('form', 'pages.form', ['title' => __('Forms')])->name('form');
    Route::view('table', 'pages.table', ['title' => __('Tables')])->name('table');
    Route::view('icon', 'pages.icon', ['title' => __('Icons')])->name('icon');
    Route::view('slider', 'pages.slider', ['title' => __('Sliders')])->name('slider');
});