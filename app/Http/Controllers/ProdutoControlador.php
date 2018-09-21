<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
    public function listar() {
    	$produtos = [
    		'Produtos 1',
    		'Produtos 2',
    		'Produtos 3',
    		'Produtos 4',
    		'Produtos 5',
    	];

    	return view('produtos', compact('produtos'));
    }

    public function palavra($palavra) {
    	return view('cardprod', compact('palavra'));
    }
}
