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
							<label>Consumed heat [MWh]</label>
						</div>
						<div class="col-sm-3">
							<label>Fuel input to the HP and CHP [MWh]</label>
						</div>
						<div class="col-sm-3">
							<label>Electricity production of the cogeneration plants [MWh]</label>
						</div>
						
					</div>
					@include('forms.PEFinputForm',['month' => 'January', 'QF'=>'1509.49','Q2'=>'1132.85','W'=>'120'])
					@include('forms.PEFinputForm',['month' => 'February', 'QF'=>'1656.49','Q2'=>'1208.06','W'=>'125'])
					@include('forms.PEFinputForm',['month' => 'March', 'QF'=>'1278.06','Q2'=>'914.68','W'=>'130'])
					@include('forms.PEFinputForm',['month' => 'April', 'QF'=>'574.73','Q2'=>'391.74','W'=>'140'])
					@include('forms.PEFinputForm',['month' => 'May', 'QF'=>'147.63','Q2'=>'102.57','W'=>'180'])
					@include('forms.PEFinputForm',['month' => 'June', 'QF'=>'116.88','Q2'=>'80.06','W'=>'200'])
					@include('forms.PEFinputForm',['month' => 'July', 'QF'=>'108.40','Q2'=>'73.29','W'=>'70'])
					@include('forms.PEFinputForm',['month' => 'August', 'QF'=>'117.54','Q2'=>'81.55','W'=>'75'])
					@include('forms.PEFinputForm',['month' => 'September', 'QF'=>'127.88','Q2'=>'88.94','W'=>'80'])
					@include('forms.PEFinputForm',['month' => 'October', 'QF'=>'503.73','Q2'=>'349.19','W'=>'90'])
					@include('forms.PEFinputForm',['month' => 'November', 'QF'=>'944.31','Q2'=>'666.42','W'=>'75'])
					@include('forms.PEFinputForm',['month' => 'December', 'QF'=>'1237.24','Q2'=>'931.60','W'=>'120'])
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