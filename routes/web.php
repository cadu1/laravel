<?php

use Illuminate\Http\Request;

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

Route::redirect('/red', '/ola', 301);

Route::view('/helloworld', 'hello', ['nome' => 'João']);

Route::get('/helloworld/{nome}/{sobnome?}', function($nome, $sobnome = null) {
    return view('hello', ['nome' => $nome, 'sobnome' => $sobnome]);
});

Route::get('/rest', function() {
    return 'hello get';
});

Route::post('/rest', function(Request $req) {
    $nome = $req->input('nome');
    return 'hello post ' . $nome;
});

Route::delete('/rest', function() {
    return 'hello delete';
});

Route::put('/rest', function() {
    return 'hello put';
});

Route::patch('/rest', function() {
    return 'hello patch';
});

Route::options('/rest', function() {
    return 'hello options';
});

Route::match(['get', 'post'], '/rest/pg', function(){
    return 'hello 2';
});

Route::any('/rest/any', function(){
    return 'hello 3';
});

Route::get('/produtos', function() {
    return '
    <h1>Produtos</h1>
    <ol>
        <li>Produto 1</li>
        <li>Produto 2</li>
        <li>Produto 3</li>
    </ol>';
})->name('produtos');

Route::get('/prodlink', function() {
    $url = route('produtos');
    return "<a href='$url'>Produtos</a>";
});

Route::get('/prod_red', function() {
    return redirect()->route('produtos');
});

Route::get('/teste', 'MeuControlador@getNome');

Route::get('/multiplica/{n1}/{n2}', 'MeuControlador@multiplica');

Route::resource('/cliente', 'ClienteControlador');

Route::view('/view', 'minhaview', ['nome' => 'carlos']);

Route::get('/view1', function() {
    return view('minhaview')->with('nome', 'joão');
});

Route::get('/view2/{nome}', function($nome) {
    $param = ['nome' => $nome];
    return view('minhaview', $param);
});

Route::get('/view3/{nome}', function($nome) {
    return view('minhaview', compact('nome'));
});

Route::get('/error', function() {
    if(View::exists('teste')) {
        return view('teste');
    } else {
        return view('error');
    }
});

Route::get('/layout', function() {
    return view('conteudo');
});

Route::get('/produtos', 'ProdutoControlador@listar');

Route::get('/produtos/{palavra}', 'ProdutoControlador@palavra');