@extends('shared.main')
@section('title', 'Multicriteria Analysis 3 method')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<div class="container">
	<div class ="row mt-3">
		<div class="col-sm-12 text-center">
			<h2><b>
				Calculator for Primary Energy Factor (PEF)
			</b></h2>
		</div>
	</div>
	<form method="post" id="form" data-parsley-validate>
		<div class="form-group">
			@csrf
			<div class ="row mt-5">
				<div class="col-sm-8 offset-2">
					<div class="row mt-1">
						<div class="col-sm-2">
							<label>Month</label>
						</div>
						<div class="col-sm-3">
							<label>Consumed Heat [MWh]</label>
						</div>
						<div class="col-sm-3">
							<label>Transferred Heat to Network [MWh]</label>
						</div>
						<div class="col-sm-3">
							<label>Hours [h]</label>
						</div>
					</div>
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
        </div>
    </form>
	<div class="row" >
		<div class="col-sm-1 offset-2">
        	<button type="submit" id="calculate"class="btn btn-primary btn-md">Calculate</button>
    	</div>
    	<h5><b>
	    	<div id="ril" class="col-sm-12">

	    	</div>
    	</b></h5>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    	$('#calculate').click(function(){
    		$.ajax({
    			type: "POST",
    			url: "PEF",
    			data: $('#form').serialize(),
    			success: function (dataTableJson) {
					$('#ril').text("Relative importance of losses (RiL): "+ dataTableJson);
  			 	}
  			});
  		});
    });
</script>
@endsection
@section('scripts')
<link rel="stylesheet" href="/js/parsley.min.js">
@endsection