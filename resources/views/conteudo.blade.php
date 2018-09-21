@extends('layout.app')

@section('titulo', 'Minha Página Filho')

@section('menu')
	@parent
    <a href="https://nova.laravel.com">Nova</a>
    <a href="https://forge.laravel.com">Forge</a>
    <a href="https://github.com/laravel/laravel">GitHub</a>
@endsection

@section('conteudo')
	<p>Este é o conteúdo do filho</p>
@endsection