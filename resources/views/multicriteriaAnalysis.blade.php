@extends('shared.main')
@section('title', 'District Model')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection
@section('content')
<div class="container">
	@csrf
	@include('forms.countrySelector')
	<div class="row mt-1" >
       <button id="evalueateButton" type="submit" class="btn btn-primary btn-md">Evaluate</button>
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
			<div id="LineChart" class ="row mt-1">
			</div>
			<div id="BarChartMA" class ="row mt-1">
			</div>
			<div id="BarChartRil" class ="row mt-1">
			</div>
			<div id="BarChartPef" class ="row mt-1">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$( window ).on( "load", function() {
	$.ajax({
    		type : "GET",
			url : "{{URL::to('region')}}",
			data:{"all":0},
 			success:function(data){
 				$('tbody').empty();
 				data.forEach(function(object) {
					$('tbody').append("<tr><td><input type=\"checkbox\" value="+object.id+" id=checkModel checked></td><td>"+object.countries.name+"/"+object.states.name+"/"+object.cities.name+"</td><td>"+object.title+"</td></tr>");
				});	
			}
 		});
	});
	$('#country').change(function(){
    var countryID = $(this).val();    
	    if(countryID){
	    	$.ajax({
	    		type : "GET",
				url : "{{URL::to('region')}}",
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
				url : "{{URL::to('region')}}",
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
				url : "{{URL::to('region')}}",
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
	
	google.charts.load('current', {'packages':['corechart']});

	function drawLineChart(data) {
		console.log(data);
		data.sort([{column: 0, desc:true}]);
		var options = {'title':'Operating Hours vs Heat Load', 'hAxis' : {'title' : 'Operating hours per year, [h]'},'vAxis' : {'title' : 'Heat Load, [MW]'}, 'legend' : {'position' : 'top', 'alignment':'end'}, 'lineWidth':1, 'pointSize':5, 'height':300, 'interpolateNulls': true,};
 		var chart = new google.visualization.LineChart(document.getElementById('LineChart'));
		chart.draw(data, options);
	}

	function drawBarChartMA(data) {
		var options = {'title' : 'Multicriteria ranking', 'hAxis' : {'title' : 'Region'},'vAxis': {'title' : 'Rank'}, 'height':300};
 		var chart = new google.visualization.ColumnChart(document.getElementById('BarChartMA'));
		chart.draw(data, options);
	}

	function drawBarChartRil(data) {
		var options = {'title' : 'Relative Importance of Losses (RiL)', 'hAxis' : {'title' : 'Region'},'vAxis': {'title' : 'RiL'}, 'height':300};
 		var chart = new google.visualization.ColumnChart(document.getElementById('BarChartRil'));
		chart.draw(data, options);
	}

	function drawBarChartPef(data) {
		var options = {'title' : 'Primary Energy Factor (PEF)', 'hAxis' : {'title' : 'Region'},'vAxis': {'title' : 'PEF'}, 'height':300};
 		var chart = new google.visualization.ColumnChart(document.getElementById('BarChartPef'));
		chart.draw(data, options);
	}
	$(document).ready(function() {
    	$('#evalueateButton').click(function (){
    		// Load google charts
			
    		var selected = [];
			$('#table1 input:checked').each(function() {
   				 selected.push($(this).attr('value'));
			});
			if (selected.length<2){
				alert("At least 2 models should be selected");
			}
			else{			
	    	 	$.ajax({
	    	 		type: "GET",
	    	 		url: "getAnalysisData",
	    			data: {"ids":selected},
	    			dataType: 'json',
	    	 		success: function (dataTableJson) {
	    	 			drawBarChartMA(google.visualization.arrayToDataTable($.parseJSON(dataTableJson.barMA)));
	    	 			drawBarChartRil(google.visualization.arrayToDataTable($.parseJSON(dataTableJson.barRil)));
	    	 			drawBarChartPef(google.visualization.arrayToDataTable($.parseJSON(dataTableJson.barPef)));
	    	 			if (dataTableJson!=null){
	    	 				var loadJson=$.parseJSON(dataTableJson.load);
	    	 				var d1=google.visualization.arrayToDataTable($.parseJSON(loadJson[0]));
		    	 			var columns=[];
		    	 			loadJson.forEach(function(dataTable, index) {
		    	 				if (index > 0) {
		    	 					columns.push(index);
	            					var d2=google.visualization.arrayToDataTable($.parseJSON(dataTable));
		    	 					d1=google.visualization.data.join(d1,d2,'full',[[0,0]],columns,[1]);
								}
							});
		    	 		}
	    	 			drawLineChart(d1);
	  			  	}
	  			 });
	    	 }
  		});
    });



</script>


@endsection
@section('scripts')
<link rel="stylesheet" href="/js/parsley.min.js">
@endsection