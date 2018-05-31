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

Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', 'DashboardController')->name('dashboard');
    Route::view('widget', 'widget', ['title' => __('Widgets')])->name('widget');

    Route::group(['prefix' => 'charts', 'as' => 'charts.'], function(){
        Route::view('chartjs', 'charts.chartjs', ['title' => 'ChartJS'])->name('chartjs');
        Route::view('flot', 'charts.flot', ['title' => 'Flot'])->name('flot');
        Route::view('inline', 'charts.inline', ['title' => 'Inline'])->name('inline');
    });

    Route::group(['prefix' => 'ui', 'as' => 'ui.'], function () {
        Route::view('general', 'ui.general', ['title' => __('General')])->name('general');
        Route::view('button', 'ui.button', ['title' => __('Buttons')])->name('button');
        Route::view('icon', 'ui.icon', ['title' => __('Icons')])->name('icon');
        Route::view('slider', 'ui.slider', ['title' => __('Sliders')])->name('slider');
    });

    Route::group(['prefix' => 'forms', 'as' => 'forms.'], function(){
        Route::view('general', 'forms.general', ['title' => __('General')])->name('general');
        Route::view('advanced', 'forms.advanced', ['title' => __('Advanced')])->name('advanced');
        Route::view('editor', 'forms.editor', ['title' => __('Editor')])->name('editor');
    });

    Route::group(['prefix' => 'tables', 'as' => 'tables.'], function(){
        Route::view('simple', 'tables.simple', ['title' => __('Simple Tables')])->name('simple');
        Route::view('datatable', 'tables.datatable', ['title' => __('Data Tables')])->name('datatable');
    });
});