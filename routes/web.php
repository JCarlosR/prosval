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

Route::post('/contact', 'ContactController@store');
Route::put('/contact', 'ContactController@update');
Route::put('/contact/spam', 'ContactController@updateSpam');

Route::get('/contact/{contact}/spam', 'ContactController@markAsSpam');
Route::get('/contact/{contact}/recover', 'ContactController@markAsActive');

// Campaigns
Route::get('/manual', 'CampaignController@manual');
Route::get('/automatico', 'CampaignController@automatic');
Route::get('/modificar-y-consultar', 'CampaignController@index');
Route::get('/detalle', 'CampaignDetailController@index');

Route::get('/inbox', 'InboxController@index');
