<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeuControllador extends Controller
{
    public function getNome() {
    	return "teste";
    }

    public function multiplica($n1, $n2) {
    	return $n1 * $n2;
    }
}
