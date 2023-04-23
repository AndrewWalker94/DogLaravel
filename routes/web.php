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
    return view('welcome');
});

Route::get('/breed', 'App\Http\Controllers\DogController@AllBreeds');
Route::get('/breed/random', 'App\Http\Controllers\DogController@GetRandomBreed');
Route::get('/breed/{breedid}/', 'App\Http\Controllers\DogController@GetBreed')->name('getbreed');
Route::get('/breed/{breedid}/image', 'App\Http\Controllers\DogController@GetBreedImage')->name('getbreedimage');

Route::get('/saveallbreeds', 'App\Http\Controllers\DogController@SaveAllBreeds');

Route::get('/cachedogs', 'App\Http\Controllers\DogController@CacheDogs');
Route::get('/getcache', 'App\Http\Controllers\DogController@GetCache');

//linking users
Route::post('/user/{user_id}/associate', 'App\Http\Controllers\UserController@LinkUser');
//linking breeds to parks
Route::post('/park/{park_id}/associate', 'App\Http\Controllers\ParkController@LinkBreed');
//get breed data
Route::get('/breed/data/{breed_id}', 'App\Http\Controllers\DogController@GetBreedData');

//creates a new park for testing
Route::get('/create/park/{name}', 'App\Http\Controllers\ParkController@CreatePark');
//creates a new user for testing
Route::get('/create/user/{name}', 'App\Http\Controllers\UserController@CreateUser');