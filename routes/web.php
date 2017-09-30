<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/import', 'TestController@import');
Route::get('/home', 'HomeController@index')->name('home');

// Contacts
Route::get('/datos', 'ContactController@data');
Route::get('/lista-spam', 'ContactController@spam');

// Campaigns
Route::get('/manual', 'CampaignController@manual');
Route::get('/automatico', 'CampaignController@automatic');
Route::get('/modificar-y-consultar', 'CampaignController@index');
Route::get('/detalle', 'CampaignDetailController@index');

Route::get('/inbox', 'InboxController@index');
