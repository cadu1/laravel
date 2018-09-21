@extends('layout.app')

@section('titulo', 'Produtos')

@section('produtos')
	@if(isset($palavra))
		Palavra: {{$palavra}}
	@endif
@endsection