@extends('layout.app')

@section('conteudo')
	<h1>Loop</h1>
	@for($i=0; $i<$n;$i++)
		<p>Número {{$i}}</p>
	@endfor


@endsection