@extends('main')
@section('title', 'Home')
@section('content')
	@if (Session::has('success'))
		<div class="alert alert-success" role="alert">
			<strong> Success: </strong>{{Session::get('success')}}
		</div>
	@endif
	@if (count($errors)>0)
		<div class="alert alert-danger" role="alert">
			<strong> Errors: </strong>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	{{-- <h1> {{$Nhv}}</h1>
	<h1> {{$a}}</h1>
	<h1> {{$b}}</h1>
	@foreach ($Nfixed as $T)
    	<h1>{{$T}}</h1>
	@endforeach
	 --}}
	 		<div  class ="row">
				<div id="f1" class="col-md-4">
					<label>Heating season</label>
				</div>
				<div id="f2" class="col-md-4">
					<label>Heating load</label>
				</div>
			</div>

	@linechart('temperature_vs_capacity', 'f1')
	@linechart('operating_vs_load', 'f2')

@endsection
