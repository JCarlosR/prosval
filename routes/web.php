<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/datos', function () {
    return view('date');
});

Route::get('/lista-spam', function () {
    return view('list-spam');
});

Route::get('/manual', function () {
    return view('manual');
});

Route::get('/automatico', function () {
    return view('automatic');
});

Route::get('/inbox', function () {
    return view('inbox');
});

Route::get('/modificar-y-consultar', function () {
    return view('modify-consult');
});

Route::get('/detalle', function () {
    return view('detail');
});
