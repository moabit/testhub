<?php

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

Route::get('/', 'IndexController@showIndexPage')->name('home');

Route::get('/test/{id}', 'IndexController@showTestPage')->where('id', '[0-9]{1,9}')->name('description');

Route::post('/test/{id}', 'TestController@startTest')->where('id', '[0-9]{1,9}');

Route::post('/test/{id}/questions', 'TestController@submitAnswers');

Route::get('test/{id}/questions', 'IndexController@showQuestions')->name('questions')->middleware('checkIfTestStarted');

Route::get('test/{id}/result', 'IndexController@showResult')->name('result');

Route::get('search/', 'SearchController@searchByTestTitle');

Route::get('/new','IndexController@showAddTest');

Route::post('/new','TestController@addNewTest');

Route::get('/search/tag/{tag}','SearchController@getTestsByTag');

Route::get('/test/', 'IndexController@showTest');
