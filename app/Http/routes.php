<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/search/cities/', function () {
    $id=$_GET['id'];
    $flights = App\City::where('city_id', $id)->get();
    
    return response()->json($flights);
});
Route::get('/search/provinces/', function () {
  $id=$_GET['id'];
  $flights = App\Province::where('province_id', $id)->get();
    
    return response()->json($flights);
});

