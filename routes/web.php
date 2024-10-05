<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::resource('student', StudentController::class);
/*
Route::get('student', 'StudentController@index')->name('student.index'); 
Route::post('student', 'StudentController@store')->name('student.store'); 
Route::post('student/create', 'StudentController@create')->name('student.create'); 
Route::get('student/{id}', 'StudentController@show')->name('student.show'); 
Route::patch('student/{id}', 'StudentController@update')->name('student.update'); 
Route::delete('student/{id}', 'StudentController@destroy')->name('student.destroy'); 
Route::get('student/{id}/edit', 'StudentController@edit')->name('student.edit');
*/