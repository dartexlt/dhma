@extends('shared.main')
@section('title', 'Home')
@section('content')

	
	
	{{-- @foreach ($temp as $T)
    	<h1>{{$T}}</h1>
	@endforeach
	 --}}
	<div  class ="row">
		<div id="f2" class="col-md-8">
			<label>Multicriteria ranking</label>
		</div>
	</div>

	@columnchart('multicriteria', 'f2')
@endsection
