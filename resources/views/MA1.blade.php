@extends('main')
@section('title', 'Multicriteria Analysis')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<form method="post" action="{{url('calc')}}" data-parsley-validate>
	@csrf
	<div class="container">
		<div class="col-md-8">
			<div class ="row">
			
				<div class="col-md-1">
					<label>Heating season</label>
				</div>
				<div class="col-md-2">
					<label>Month</label>
				</div>
				<div class="col-md-3">
					<label>Transferred heat to network</label>
				</div>
				<div class="col-md-3">
					<label>Hours</label>
				</div>
				<div class="col-md-3">
					<label>Average outdoor temperature</label>
				</div>
			</div>
		</div>
		<div class ="row">
			<div class="col-md-8">
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
			</div>
			<div class="col-md-4">
				<label>Climate data</label>
				@include('climate_data_input',['title' => 'h83','value'=>'8760'])
				@include('climate_data_input',['title' => 'h82','value'=>'4872'])
				@include('climate_data_input',['title' => 'h8','value'=>'4872'])
				@include('climate_data_input',['title' => 'h5','value'=>'3989'])
				@include('climate_data_input',['title' => 'h0','value'=>'2835'])
				@include('climate_data_input',['title' => 'h_5','value'=>'1050'])
				@include('climate_data_input',['title' => 'h_10','value'=>'518'])
				@include('climate_data_input',['title' => 'h_15','value'=>'305'])
				@include('climate_data_input',['title' => 'h_20','value'=>'104'])
				@include('climate_data_input',['title' => 'h_25','value'=>'14'])
			</div>
        </div>

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