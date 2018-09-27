<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Categoria;
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

Route::get('/mostraopt', 'ProdutoControlador@mostraopt');

Route::get('/opcao/{opt}', 'ProdutoControlador@opcoes');

Route::get('/loop/{n}', 'ProdutoControlador@loop');

Route::get('/categorias', function() {
    $cats = DB::table('categorias')->get();
    foreach($cats as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }

    echo '<hr>';
    $cats2 = DB::table('categorias')->pluck('nomes');
    foreach($cats2 as $c) {
        echo "Nome: $c<br>";
    }

    echo '<hr>';
    $cats2 = DB::table('categorias')->where('id', 1)->get();
    foreach($cats2 as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }

    echo '<hr>';
    $cat = DB::table('categorias')->where('id', 1)->first();
    echo "Id: {$cat->id}, Nome: {$cat->nomes}<br>";

    echo '<hr>';
    $cats2 = DB::table('categorias')->where('nomes', 'like', '%1')->get();
    foreach($cats2 as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }

    echo '<hr>';
    $cats2 = DB::table('categorias')->where('id', '1')->orWhere('id', '3')->get();
    foreach($cats2 as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }

    echo '<hr>';
    $cats2 = DB::table('categorias')->whereBetween('id', [1,3])->get();
    foreach($cats2 as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }

    echo '<hr>';
    $cats2 = DB::table('categorias')->whereNotBetween('id', [1,2])->get();
    foreach($cats2 as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }

    echo '<hr>';
    $cats2 = DB::table('categorias')->whereIn('id', [1,3,4])->get();
    foreach($cats2 as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }

    echo '<hr>';
    $cats2 = DB::table('categorias')->where([
        ['id', 1],
        ['nomes', 'like', '%1'],
    ])->get();
    foreach($cats2 as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }

    echo '<hr>';
    $cats2 = DB::table('categorias')->orderBy('nomes', 'desc')->get();
    foreach($cats2 as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }
});

Route::get('/nova_categoria', function() {
    $id = DB::table('categorias')->insertGetId(['nomes' => 'Teste 7']);

    echo $id;
});

Route::get('/atualiza_registro', function() {
    $cat = DB::table('categorias')->where('id', 1)->first();
    echo "Id: {$cat->id}, Nome: {$cat->nomes}<br>";

    DB::table('categorias')->where('id', 1)->update(['nomes' => 'Teste 1 Alterado']);

    $cat = DB::table('categorias')->where('id', 1)->first();
    echo "Id: {$cat->id}, Nome: {$cat->nomes}<br>";
});

Route::get('/remove_cat', function() {
    $cats = DB::table('categorias')->get();
    foreach($cats as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }

    DB::table('categorias')->where('id', 6)->delete();
    echo '<hr>';

    $cats = DB::table('categorias')->get();
    foreach($cats as $c) {
        echo "Id: {$c->id}, Nome: {$c->nomes}<br>";
    }
});

Route::get('/novo_cat/{nome}', function($nome) {
    $cat = new Categoria();
    $cat->nomes = $nome;

    $cat->save();
    return redirect('/lista_cat');
});

Route::get('/lista_cat', function() {
    $categorias = Categoria::all();
    foreach ($categorias as $c) {
        echo "Id: {$c->id}, Nome {$c->nomes}<br>";
    }
});

Route::get('/lista_cat/{id}', function($id) {
    $cat = Categoria::find($id);
    if(isset($cat)) {
        echo "Id: {$cat->id}, Nome {$cat->nomes}<br>";
    } else {
        echo "Registro não localizado";
    }
});

Route::get('/atualiza_cat/{id}/{nome}', function($id, $nome) {
    $cat = Categoria::find($id);
    if( isset($cat) ) {
        $cat->nomes = $nome;
        $cat->save();

        return redirect('/lista_cat');
    } else {
        echo "Registro não localizado";
    }
});

Route::get('/remove_cat/{id}', function($id) {
    $cat = Categoria::find($id);
    if( isset($cat) ) {
        $cat->delete();

        return redirect('/lista_cat');
    } else {
        echo "Registro não localizado";
    }
});

Route::get('/cat_nome/{nome}', function($nome) {
    $cats = Categoria::where('nomes', $nome)->get();

    foreach ($cats as $c) {
        echo "Id: {$c->id}, Nome {$c->nomes}<br>";
    }
});

Route::get('/cat_maior/{id}', function($id) {
    $cats = Categoria::where('id', '>=', $id)->get();

    foreach ($cats as $c) {
        echo "Id: {$c->id}, Nome {$c->nomes}<br>";
    }

    $cats = Categoria::where('id', '>=', $id)->count();
    echo "Count: $cats<br>";

    $cats = Categoria::where('id', '>=', $id)->max('id');
    echo "Max: $cats<br>";

});

Route::get('/cat_todas', function() {
    $cats = Categoria::withTrashed()->get();

    foreach ($cats as $c) {
        $trash = $c->trashed() ? 'Sim' : 'Não';
        echo "Id: {$c->id}, Nome {$c->nomes}, Excluído: $trash<br>";
    }
});

Route::get('/cat_ver/{id}', function($id) {
    $cat = Categoria::withTrashed()->find($id);
    $cat = Categoria::withTrashed()->where('id', $id)->get()->first();

    if (isset($cat)) {
        $trash = $cat->trashed() ? 'Sim' : 'Não';
        echo "Id: {$cat->id}, Nome {$cat->nomes}, Excluído: $trash<br>";
    } else {
        echo "Registro não encontrado";
    }
});

Route::get('/cat_verrem', function() {
    $cats = Categoria::onlyTrashed()->get();

    foreach ($cats as $c) {
        $trash = $c->trashed() ? 'Sim' : 'Não';
        echo "Id: {$c->id}, Nome {$c->nomes}, Excluído: $trash<br>";
    }
});