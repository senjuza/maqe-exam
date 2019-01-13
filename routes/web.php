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



Route::get('/', 'BotController@sayHello')->name('bot.hi');
Route::post('/bot/calculate', 'BotController@calculateDirection')->name('bot.calculate');