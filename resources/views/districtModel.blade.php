@extends('main')
@section('title', 'District Model')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<div class="container">
	<form method="post" id="f1" action="{{url('model')}}" data-parsley-validate>
		@csrf
		@include('forms.countrySelector')
		<div class ="row">
			<label for=title class="col-sm-6 col-form-label col-form-label-sm">Model name</label>
			<input type="text" class="form-control form-control-sm" name=title placeholder="e.g. Klaipeda default model" value="" required data-parsley-value="text">
		</div>
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
			<div class="row mt-2">			
				<div class="col-sm-6">
					<div class="row mt-2">
						<div class="col-sm-12 text-center">
							<label>Operating hours for apropriate temperatures</label>
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
				<div class="col-sm-6">
					<div class ="row  mt-1">
						<div class="col-sm-8">
							<label for=Nave class="col-sm-12 col-form-label col-form-label-sm">Heating capacity at average outdoor temperature [MW]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=Nave placeholder="" value=1.13  data-parsley-type="number">
						</div>				
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=N2hv class="col-sm-12 col-form-label col-form-label-sm">Hot water capacity at average outdoor temperature [MW]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=N2hw placeholder="" value=0.12  data-parsley-type="number">
						</div>				
					</div>		
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=Nl class="col-sm-12 col-form-label col-form-label-sm">Heat losses capacity at average outdoor temperature [MW]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=Nl placeholder="" value=0.17  data-parsley-type="number">
						</div>				
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tao class="col-sm-12 col-form-label col-form-label-sm">Average outdoor temperature  [°C]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=tao placeholder="" value=0  data-parsley-type="number">
						</div>				
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Average room temperature  [°C]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=tar placeholder="" value=18  data-parsley-type="number">
						</div>																	
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Specific fuel consumption [MWh/MWh]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=x1 placeholder="" value="" data-parsley-type="number">
						</div>																	
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Power to heat ratio [MWh/MWh]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=x2 placeholder="" value="" equired data-parsley-type="number">
						</div>																	
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Specific heat consumption per m2 [kWh/m2]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=x3 placeholder="" value="" equired data-parsley-type="number">
						</div>																	
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">RES share [%]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=x4 placeholder="" value="" equired data-parsley-type="number">
						</div>																	
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Legal regulation of Low-temperature DH</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=x5 placeholder="" value="" equired data-parsley-type="number">
						</div>																	
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Specific heat losses in network [kWh/MWh]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=x6 placeholder="" value="" equired data-parsley-type="number">
						</div>																	
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Specific CO2 emissions [t CO2(fuel)/MWh(con.)]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=x7 placeholder="" value="" equired data-parsley-type="number">
						</div>																	
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Specific power consumption [kWh/MWh]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=x8 placeholder="" value="" equired data-parsley-type="number">
						</div>																	
					</div>
					<div class ="row mt-1">
						<div class="col-sm-8">
							<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Affordability [%]</label>
						</div>
						<div class="col-sm-4">
							<input type="number" step="0.0001" class="form-control form-control-sm" name=x9 placeholder="" value="" equired data-parsley-type="number">
						</div>																	
					</div>
				</div>
			</div>
			<div class="row" >
	           <button type="submit" class="btn btn-primary btn-md">Save to Database</button>
			</div>
		</form>

</div>
@endsection
@section('scripts')
<link rel="stylesheet" href="/js/parsley.min.js">
@endsection