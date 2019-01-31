@extends('main')
@section('title', 'Home')
@section('content')
 {{csrf_field()}}
		<div class="row" >
              <button id="b1"type="submit" class="btn btn-primary btn-md">Submit</button>
		</div>
 <div  class ="row">
				<div id="f1" class="col-md-4">
					<label>Heating season</label>
				</div>
				<div id="f2" class="col-md-4">
					<label>Heating load</label>
				</div>
			</div>

{{-- 	@linechart('temperature_vs_capacity', 'f1')
	@linechart('operating_vs_load', 'f2')
 --}}

<script type="text/javascript">
	$(document).ready(function() {
    	$('#b1').click(function(){
    		$.getJSON({{url('/ma1')}}, function (dataTableJson) {
  				console.log(dataTableJson);
            	lava.loadData('f1', dataTableJson.data1, function (chart) {
              		console.log('chart 1 loadData callback');
              		console.log(chart);
            	});
            	lava.loadData('f2', dataTableJson.data2, function (chart) {
            		console.log('chart 2 loadData callback');
            		console.log(chart);
  				});
  			});
  		});
    });
</script>

@endsection
