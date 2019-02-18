@extends('shared.main')
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
		<div  class ="row">
		<div id="f2" class="col-md-4">
			<label>Heating load</label>
		</div>
	</div>

	{{-- @linechart('operating_vs_load', 'f2') --}}

@endsection
