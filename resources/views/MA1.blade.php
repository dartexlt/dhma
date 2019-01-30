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
				@include('forms.inputform',['month' => 'January', 'Qval'=>'1207.59', 'hval'=>'744.00', 'tval'=>'-2.01', 'c'=>'checked'])
				@include('forms.inputform',['month' => 'February', 'Qval'=>'1325.19', 'hval'=>'672.00', 'tval'=>'-6.99', 'c'=>'checked'])
				@include('forms.inputform',['month' => 'March', 'Qval'=>'1022.45', 'hval'=>'744.00', 'tval'=>'0.80', 'c'=>'checked'])
				@include('forms.inputform',['month' => 'April', 'Qval'=>'459.78', 'hval'=>'720.00', 'tval'=>'7.84', 'c'=>'checked'])
				@include('forms.inputform',['month' => 'May', 'Qval'=>'118.10', 'hval'=>'744.00', 'tval'=>'12.54', 'c'=>''])
				@include('forms.inputform',['month' => 'June', 'Qval'=>'93.50', 'hval'=>'720.00', 'tval'=>'18.63', 'c'=>''])
				@include('forms.inputform',['month' => 'July', 'Qval'=>'86.72', 'hval'=>'744.00', 'tval'=>'21.13', 'c'=>''])
				@include('forms.inputform',['month' => 'August', 'Qval'=>'94.03', 'hval'=>'744.00', 'tval'=>'17.89', 'c'=>''])
				@include('forms.inputform',['month' => 'September', 'Qval'=>'102.30', 'hval'=>'720.00', 'tval'=>'14.26', 'c'=>''])
				@include('forms.inputform',['month' => 'October', 'Qval'=>'402.98', 'hval'=>'744.00', 'tval'=>'8.40', 'c'=>'checked'])
				@include('forms.inputform',['month' => 'November', 'Qval'=>'755.45', 'hval'=>'720.00', 'tval'=>'4.70', 'c'=>'checked'])
				@include('forms.inputform',['month' => 'December', 'Qval'=>'989.79', 'hval'=>'744.00', 'tval'=>'2.11', 'c'=>'checked'])
			</div>
			<div class="col-md-4">
				<label>Climate data</label>
				@include('forms.climate_data_input',['title' => 'h83','value'=>'8760'])
				@include('forms.climate_data_input',['title' => 'h82','value'=>'4872'])
				@include('forms.climate_data_input',['title' => 'h8','value'=>'4872'])
				@include('forms.climate_data_input',['title' => 'h5','value'=>'3989'])
				@include('forms.climate_data_input',['title' => 'h0','value'=>'2835'])
				@include('forms.climate_data_input',['title' => 'h_5','value'=>'1050'])
				@include('forms.climate_data_input',['title' => 'h_10','value'=>'518'])
				@include('forms.climate_data_input',['title' => 'h_15','value'=>'305'])
				@include('forms.climate_data_input',['title' => 'h_20','value'=>'104'])
				@include('forms.climate_data_input',['title' => 'h_25','value'=>'14'])
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