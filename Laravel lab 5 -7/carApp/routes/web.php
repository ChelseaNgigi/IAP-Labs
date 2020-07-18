<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('newcar');
});
Route::post('/car','CarController@newCar');
Route::get('/car/{id}','CarController@particularCar');
Route::get('/cars','CarController@allCars');
Route::get('/newcar','CarController@newCar');

Route::post('cars/{id}/carReviews/create','ReviewsController@create');
Route::get('cars','CarController@cars');
Route::post('cars/newcar','CarController@newcar');
Route::get('car/{id}/carReviews','ReviewsController@carReviews');
Route::get('car/carReviews/{id}','ReviewsController@carDetails');


