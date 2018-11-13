@extends('main')
@section('title', 'Multicriteria Analysis')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<form method="post" action="{{url('calc')}}" data-parsley-validate>
	@csrf
	<div class="container">
		<div class ="row">
			<div class="col-md-1">
				<label>Heating season</label>
			</div>
			<div class="col-md-1">
				<label>Month</label>
			</div>
			<div class="col-md-1">
				<label>Transferred heat to network</label>
			</div>
			<div class="col-md-1">
				<label>Hours</label>
			</div>
			<div class="col-md-1">
				<label>Average outdoor temperature</label>
			</div>
		</div>
		@include('inputform',['month' => 'January'])
		@include('inputform',['month' => 'February'])
		@include('inputform',['month' => 'March'])
		@include('inputform',['month' => 'April'])
		@include('inputform',['month' => 'May'])
		@include('inputform',['month' => 'June'])
		@include('inputform',['month' => 'July'])
		@include('inputform',['month' => 'August'])
		@include('inputform',['month' => 'September'])
		@include('inputform',['month' => 'October'])
		@include('inputform',['month' => 'November'])
		@include('inputform',['month' => 'December'])
        {{csrf_field()}}
		<div class="row" >
              <button type="submit" class="btn btn-primary btn-md">Submit</button>
		</div>
	</div>
</form>
@endsection
@section('scripts')
<link rel="stylesheet" href="/js/parsley.min.js">
@endsection