@extends('main')
@section('title', 'Multicriteria Analysis')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
{{-- <form id="form" method="post" action="{{url('calc')}}" data-parsley-validate> --}}
<div class="container">
	<form id="form" method="post" data-parsley-validate>
		<div class="form-group">
			@csrf
			<div class ="row">
				<div class="col-sm-7">
					<div class="row mt-1">
						<div class="col-sm-2 text-right">
							<label>Heating season</label>
						</div>
						<div class="col-sm-2">
							<label>Month</label>
						</div>
						<div class="col-sm-3">
							<label>Transferred heat to network [MWh]</label>
						</div>
						<div class="col-sm-2">
							<label>Hours [h]</label>
						</div>
						<div class="col-sm-3">
							<label>Average outdoor temperature [°C]</label>
						</div>
					</div>
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

				<div class="col-sm-5">
					<div class="row mt-2">
						<div class="col-sm-12 text-center">
							<label>Total Operating Hours in a Year at Apropriate Outdor Temperatures:</label>
						</div>
					</div>
					@include('forms.climate_data_input',['title' => 'h83','label' => 'Total Hours in a Year [h]','value'=>'8760'])
					@include('forms.climate_data_input',['title' => 'h82','label' => 'Total Hours in a Heating Season [h]','value'=>'4872'])
					@include('forms.climate_data_input',['title' => 'h8','label' => 'Total Operating Hours at <8°C [h]','value'=>'4872','t'=>'8'])
					@include('forms.climate_data_input',['title' => 'h5','label' => 'Total Operating Hours at <5°C [h]','value'=>'3989','t'=>'5'])
					@include('forms.climate_data_input',['title' => 'h0','label' => 'Total Operating Hours at <0°C [h]','value'=>'2835','t'=>'0'])
					@include('forms.climate_data_input',['title' => 'h_5','label' => 'Total Operating Hours at <-5°C [h]','value'=>'1050','t'=>'-5'])
					@include('forms.climate_data_input',['title' => 'h_10','label' => 'Total Operating Hours at <-10°C [h]','value'=>'518','t'=>'-10'])
					@include('forms.climate_data_input',['title' => 'h_15','label' => 'Total Operating Hours at <-15°C [h]','value'=>'305','t'=>'-15'])
					@include('forms.climate_data_input',['title' => 'h_20','label' => 'Total Operating Hours at <-20°C [h]','value'=>'104','t'=>'-20'])
					@include('forms.climate_data_input',['title' => 'h_25','label' => 'Total Operating Hours at <-25°C [h]','value'=>'14','t'=>'-25'])
				</div>
			</div>
		</div>
	</form>
	<div class="row mt-1" >
        <button id="b1" type="submit" class="btn btn-primary btn-md">Calculate</button>
	</div>
	<div  class ="row mt-1">
		<div id="f1" class="col-md-6">
			<label>Heating season</label>
		</div>
		<div id="f2" class="col-md-6">
			<label>Heating load</label>
		</div>
	</div>
	{{-- {!! Lava::lavajs() !!} --}}
	
	@linechart('temperature_vs_capacity', 'f1')
	@linechart('operating_vs_load', 'f2')
</div>

<script type="text/javascript">
	$(document).ready(function() {
    	$('#b1').click(function(){
    		$.ajax({
    			type: "POST",
    			url: "/Amet1",
    			data: $('#form').serialize(),
    			success: function (dataTableJson) {
  			 	console.log(dataTableJson);
  			 	       	lava.loadData('temperature_vs_capacity', dataTableJson.data1, function (chart) {
                		console.log('chart 1 loadData callback');
                		console.log(chart);
             	});
              	lava.loadData('operating_vs_load', dataTableJson.data2, function (chart) {
              		console.log('chart 2 loadData callback');
         		console.log(chart);
 	 });
  			 }
  			});
  		});
    });
</script>
@endsection
@section('scripts')
{{-- <link rel="stylesheet" href="/js/parsley.min.js">  --}}
@endsection