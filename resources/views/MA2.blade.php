@extends('main')
@section('title', 'Multicriteria Analysis 2 Method')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<form method="post" action="{{url('calc2')}}" data-parsley-validate>
	@csrf
	<div class="container">
		<div class ="row">
			<div class="col-md-8">
				<div class ="row">
					<div class="form-group col-sm-6">
						<label for=Nave class="col-sm-12 col-form-label col-form-label-sm">Heating capacity at average outdoor temperature</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=Nave placeholder="" value=1.13 equired data-parsley-type="number">
					</div>				
				</div>
				<div class ="row">
					<div class="form-group col-sm-6">
						<label for=N2hv class="col-sm-12 col-form-label col-form-label-sm">Hot water capacity at average outdoor temperature</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=N2hw placeholder="" value=0.12 equired data-parsley-type="number">
					</div>				
				</div>		
				<div class ="row">
					<div class="form-group col-sm-6">
						<label for=Nl class="col-sm-12 col-form-label col-form-label-sm">Heat losses capacity at average outdoor temperature</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=Nl placeholder="" value=0.17 equired data-parsley-type="number">
					</div>				
				</div>
				<div class ="row">
					<div class="form-group col-sm-6">
						<label for=tao class="col-sm-12 col-form-label col-form-label-sm">Average outdoor temperature</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=tao placeholder="" value=0 equired data-parsley-type="number">
					</div>				
				</div>
				<div class ="row">
					<div class="form-group col-sm-6">
						<label for=tar class="col-sm-12 col-form-label col-form-label-sm">Average room temperature</label>
					</div>
					<div class="col-sm-4">
						<input type="number" step="0.0001" class="form-control form-control-sm" name=tar placeholder="" value=18 equired data-parsley-type="number">
					</div>																	
				</div>
			</div>
			<div class="col-md-4">
				<label>Operating hours for apropriate temperature</label>
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