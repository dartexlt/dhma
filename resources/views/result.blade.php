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
	<h1> {{$model->nhv}}</h1>
<h1> {{$model->months->where('parameter_id', '3')->pluck('january')}}</h1>
<h1> {{$model->months->where('parameter_id', '3')->first()->may}}</h1>
<h1> {{$model->months->where('parameter_id', '3')->first()->june}}</h1>
	
@endsection
