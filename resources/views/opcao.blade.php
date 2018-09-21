@extends('layout.app')

@section('conteudo')
	Você escolheu a opção:
	@if(isset($opt))
		@switch($opt)
			@case(1)
				<span class="badge badge-primary">{{$opt}}</span>
				@break;
			@case(2)
				<span class="badge badge-danger">{{$opt}}</span>
				@break;
			@case(3)
				<span class="badge badge-warning">{{$opt}}</span>
				@break;
			@default
				<span class="badge badge-success">{{$opt}}</span>
		@endswitch
	@endif
@endsection