<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Weidner\Goutte\GoutteFacade;
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

// routes/web.php

Route::get('dat', function() {
    $crawler = GoutteFacade::request('GET', 'https://dantri.com.vn/the-thao/bong-da-trong-nuoc.htm');
    $crawler->filter('h3.news-item__title')->each(function ($node) {
     echo $node->text(). "</br>";
    });

});
Route::get('tao_bang',function(){
    Schema::create('chung_khoan', function ($table) {

            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table-> text('phone');

            $table ->string('address',255);
            $table->text('avartar');

            $table->rememberToken();
            $table->timestamps();
    });
});
Route::get('users','UserChartController@index');
Route::get('dat','UserChartController@dat');
