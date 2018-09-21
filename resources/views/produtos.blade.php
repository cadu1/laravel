@extends('layout.app')

@section('titulo', 'Produtos')

@section('conteudo')
	<p>Lista de Produtos</p>
	@if(isset($produtos))
		@if(count($produtos) > 0)
			<h1>Produtos</h1>
			@foreach($produtos as $p)
				<p>Nome: {{$p}}</p>
			@endforeach
		@else
			<h1>Nenhum produto encontrado</h1>
		@endif
	@else
		<h2>Sem Produtos</h2>
	@endif

	@empty($produtos)
		<h2>Nenhum produto encontrado</h2>
	@endempty
@endsection