@extends('main')
@section('title', 'District Model')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<div class="container">
	@csrf
	@include('forms.countrySelector')
	<div class="row mt-1" >
       <button id="b3" type="submit" class="btn btn-primary btn-md">Evaluate</button>
	</div>
	<div class="row mt-2">
		<div class="col-sm-6">
			<table id="table1" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th></th>
				 		<th>Country/State/City</th>
				 		<th>Model Name</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<div  class="col-sm-6">
			<div id="f4" class ="row mt-1">
				<label>Heating load</label>
			</div>
			<div id="f5" class ="row mt-1">
				<label>Multicriteria ranking</label>
			</div>
		</div>
			@linechart('operating_vs_load', 'f4')
			@columnchart('multicriteria', 'f5')



	



	</div>
</div>
<script type="text/javascript">
	$('#country').change(function(){
    var countryID = $(this).val();    
	    if(countryID){
	    	$.ajax({
	    		type : "GET",
				url : "{{URL::to('search')}}",
				data:{"country":countryID},
	 			success:function(data){
	 				$('tbody').empty();
	 				data.forEach(function(object) {
						$('tbody').append("<tr><td><input type=\"checkbox\" value="+object.id+" id=checkModel checked></td><td>"+object.countries.name+"/"+object.states.name+"/"+object.cities.name+"</td><td>"+object.title+"</td></tr>");
					});	
				}
	 		});
		} 
	}); 
	$('#state').on('change',function(){
	    var stateID = $(this).val();    
	    if(stateID){
	        $.ajax({
				type : "GET",
				url : "{{URL::to('search')}}",
				data:{"country":$('#country').val(), "state":stateID},
	 			success:function(data){
					$('tbody').empty();
					data.forEach(function(object) {
						$('tbody').append("<tr><td><input type=\"checkbox\" value="+object.id+" id=checkModel checked></td><td>"+object.countries.name+"/"+object.states.name+"/"+object.cities.name+"</td><td>"+object.title+"</td></tr>");

					});
	 			}
	 		});
		} 
	}); 
	$('#city').on('change',function(){
	    var cityID = $(this).val();    
	    if(cityID){
	        $.ajax({
				type : "GET",
				url : "{{URL::to('search')}}",
				data:{"country":$('#country').val(),"state":$('#state').val(), "city":cityID},
	 			success:function(data){
	 				$('tbody').empty();
	 				data.forEach(function(object) {
						$('tbody').append("<tr><td><input type=\"checkbox\" value="+object.id+" id=checkModel checked></td><td>"+object.countries.name+"/"+object.states.name+"/"+object.cities.name+"</td><td>"+object.title+"</td></tr>");

					});		
	 			}
	 		});
		} 
	}); 
	$(document).ready(function() {
    	$('#b3').click(function(){
    		// $('#checkModel').each(function(i,obj){
    		// 	console.log(i);	
    		// });
    		var selected = [];
			$('#table1 input:checked').each(function() {
   				 selected.push($(this).attr('value'));
			});
			console.log(selected);	

    	 	$.ajax({
    	 		type: "GET",
    	 		url: "getAnalysisData",
    			data: {"ids":selected},
    	 		success: function (dataTableJson) {
	  			  	console.log(dataTableJson);
	               	lava.loadData('operating_vs_load', dataTableJson.data1, function (chart) {
	           			console.log('chart 1 loadData callback');
	 					console.log(chart);	
	 		 		});
	 		 		lava.loadData('multicriteria', dataTableJson.data2, function (chart) {
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