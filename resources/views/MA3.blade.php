@extends('main')
@section('title', 'Multicriteria Analysis 3 method')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<form method="post" action="{{url('calc3')}}" data-parsley-validate>
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
				@include('forms.inputForm3Method',['month' => 'January', 'Q'=>'1207.59','Q2'=>'1132.85','h'=>'744'])
				@include('forms.inputForm3Method',['month' => 'February', 'Q'=>'1325.19','Q2'=>'1208.06','h'=>'672'])
				@include('forms.inputForm3Method',['month' => 'March', 'Q'=>'1022.45','Q2'=>'914.68','h'=>'744'])
				@include('forms.inputForm3Method',['month' => 'April', 'Q'=>'459.78','Q2'=>'391.74','h'=>'720'])
				@include('forms.inputForm3Method',['month' => 'May', 'Q'=>'118.10','Q2'=>'102.57','h'=>'744'])
				@include('forms.inputForm3Method',['month' => 'June', 'Q'=>'93.50','Q2'=>'80.06','h'=>'720'])
				@include('forms.inputForm3Method',['month' => 'July', 'Q'=>'86.72','Q2'=>'73.29','h'=>'744'])
				@include('forms.inputForm3Method',['month' => 'August', 'Q'=>'94.03','Q2'=>'81.55','h'=>'744'])
				@include('forms.inputForm3Method',['month' => 'September', 'Q'=>'102.30','Q2'=>'88.94','h'=>'720'])
				@include('forms.inputForm3Method',['month' => 'October', 'Q'=>'402.98','Q2'=>'349.19','h'=>'744'])
				@include('forms.inputForm3Method',['month' => 'November', 'Q'=>'755.45','Q2'=>'666.42','h'=>'720'])
				@include('forms.inputForm3Method',['month' => 'December', 'Q'=>'989.79','Q2'=>'931.60','h'=>'744'])
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