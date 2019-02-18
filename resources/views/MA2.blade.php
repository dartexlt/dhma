@extends('shared.main')
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
				<div class="col-sm-7">
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
  			 		lava.loadData('operating_vs_load', dataTableJson);
  			 	}
  			});
  		});
    });
</script>
@endsection
@section('scripts')
<link rel="stylesheet" href="/js/parsley.min.js">
@endsection