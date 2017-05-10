<?php


Route::get('/', function () {
	return view('welcome');
});


Route::get('rezervace', 'cLHRezervace1Controller@index');
Route::post('rezervace', 'cLHRezervace1Controller@store');



