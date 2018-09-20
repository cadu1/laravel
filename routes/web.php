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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function () {
    return '<h1>Seja bem vindo</h1>';
});

Route::get('/ola/{nome}', function ($nome) {
    return "<h1>Olá, $nome</h1>";
});

Route::get('/ola/{nome}/{sobnome}', function ($nome, $sobnome) {
    return "<h1>Olá, $nome $sobnome</h1>";
});

Route::get('/repetir/{nome}/{num}', function($nome, $num) {
    for($i = 0; $i < $num; $i++) {
        echo "<h1>$nome</h1>";
    }
})->where('num', '[0-9]+')->where('nome', '[A-Za-z]+');

Route::get('opcional/{nome?}', function($nome=null) {
   echo var_dump($nome);
});

Route::prefix('app')->group(function() {
   Route::get('/', function() {
       return 'Página inicial do APP';
   });
   Route::get('profile', function() {
       return 'Página profile';
   });
   Route::get('about', function() {
       return 'Página about';
   });
});