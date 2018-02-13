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
Route::get('/campaigns', 'CampaignController@index');
Route::get('/campaigns/create/manual', 'CampaignController@manual');
Route::post('/campaigns', 'CampaignController@store');
Route::get('/campaigns/edit/{campaign}', 'CampaignController@edit');
Route::put('/campaigns/edit/{campaign}/status', 'CampaignController@status');
Route::post('/campaigns/{campaign}/upload', 'CampaignController@upload');
Route::get('/campaigns/{campaign}/delete', 'CampaignController@destroy');
// Details
Route::post('/campaigns/{campaign}/details', 'CampaignDetailController@store');
Route::get('/campaigns/details/{detail}/delete', 'CampaignDetailController@destroy');
Route::put('/campaigns/details', 'CampaignDetailController@update');
Route::get('/campaigns/{campaign}/details', 'CampaignDetailController@index');

Route::get('/campaigns/create/automatic', 'CampaignController@automatic');
Route::get('/detalle', 'CampaignDetailController@index');

Route::get('/inbox', 'InboxController@index');
Route::post('/inbox', 'InboxController@sendMessage');
Route::get('/inbox/messages/webhook', 'WebHookController@webHook');
Route::get('/contact/{contact}/messages', 'InboxController@renderInboxMessages');
