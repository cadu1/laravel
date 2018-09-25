<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
        	'nomes' => 'Teste 1'
        ]);
        DB::table('categorias')->insert([
        	'nomes' => 'Teste 2'
        ]);
        DB::table('categorias')->insert([
        	'nomes' => 'Teste 3'
        ]);
        DB::table('categorias')->insert([
        	'nomes' => 'Teste 4'
        ]);
    }
}
