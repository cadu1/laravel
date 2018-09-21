@extends('layout.app')

@section('titulo', 'Produtos')

@section('conteudo')
	<p>Lista de Produtos</p>
	@if(isset($produtos))
		@if(count($produtos) > 0)
			<h1>Produtos</h1>
			@foreach($produtos as $p)
				<p>Nome: {{$p}}</p>
				@if($loop->first)
					(primeiro)
				@endif
				@if($loop->last)
					(último)
				@endif
				<span class="badge badge-secondary">{{$loop->index}} / {{$loop->count}} / {{$loop->remaining}}</span>
				<span class="badge badge-secondary">{{$loop->iteration}} / {{$loop->count}}</span>
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