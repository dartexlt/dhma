@extends('main')
@section('title', 'Multicriteria Analysis 2 Method')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<div class="container">
	<form method="post" id="form2"  data-parsley-validate>
		@csrf
		<div class="form-group">
		<div class ="row">
			<div class="col-sm-6">
				<div class ="row mt-1">
					<div class="col-sm-8">
						<label for=Nave class="col-sm-12 col-form-label col-form-label-sm">Heating capacity at average outdoor temperature [MW]</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=Nave placeholder="" value=1.13 equired data-parsley-type="number">
					</div>				
				</div>
				<div class ="row mt-1">
					<div class="col-sm-8">
						<label for=N2hv class="col-sm-12 col-form-label col-form-label-sm">Hot water capacity at average outdoor temperature [MW]</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=N2hw placeholder="" value=0.12 equired data-parsley-type="number">
					</div>				
				</div>		
				<div class ="row mt-1">
					<div class="col-sm-8">
						<label for=Nl class="col-sm-12 col-form-label col-form-label-sm">Heat losses capacity at average outdoor temperature [MW]</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=Nl placeholder="" value=0.17 equired data-parsley-type="number">
					</div>				
				</div>
				<div class ="row mt-1">
					<div class="col-sm-8">
						<label for=tao class="col-sm-12 col-form-label col-form-label-sm">Average outdoor temperature [°C]</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=tao placeholder="" value=0 equired data-parsley-type="number">
					</div>				
				</div>
				<div class ="row mt-1">
					<div class="col-sm-8">
						<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Average room temperature [°C]</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=tar placeholder="" value=18 equired data-parsley-type="number">
					</div>																	
				</div>
			</div>
			<div class="col-sm-6">
				<div class="row mt-1">
					<div class="col-sm-12 text-center">
						<label>Operating hours for apropriate temperature [h]</label>
					</div>
				</div>
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
	</div>
	</form>
	<div class="row mt-1" >
        <button id="b1" type="submit" class="btn btn-primary btn-md">Calculate</button>
	</div>
	<div  class ="row mt-1">
		<div id="f3" class="col-sm-6">
			<label>Heating load</label>
		</div>
	</div>
	{{-- {!! Lava::lavajs() !!} --}}
	
	<div class="row mt-1" >
	@linechart('operating_vs_load', 'f3')
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    	$('#b1').click(function(){
    		$.ajax({
    			type: "POST",
    			url: "/Amet2",
    			data: $('#form2').serialize(),
    			success: function (dataTableJson) {
  			 		console.log(dataTableJson);
              		lava.loadData('operating_vs_load', dataTableJson, function (chart) {
              			console.log('chart 1 loadData callback');
         				console.log(chart);
 	 				});
  			 	}
  			});
  		});
    });
</script>
@endsection
@section('scripts')
<link rel="stylesheet" href="/js/parsley.min.js">
@endsection