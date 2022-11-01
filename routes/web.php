<?php

use Illuminate\Support\Facades\Route;

/*
 Here is where one can register web routes for the application. These
 routes are loaded by the RouteServiceProvider within a group which
 contains the "web" middleware group. /
 Defines routes that will be used by the web interface. 

*/

Route::get('/', function () {
    return view('welcome');
});
