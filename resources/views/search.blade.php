@extends('main')
@section('title', 'District Model')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<div class="container">
	@csrf
	@include('forms.countrySelector')
	<div class="row" >
       <button type="submit" class="btn btn-primary btn-md">Submit</button>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
				 		<th>ID</th>
				 		<th>Model Name</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
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
						$('tbody').append("<tr><td>"+object.id+"</td><td>"+object.title+"</td></tr>");
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
						$('tbody').append("<tr><td>"+object.id+"</td><td>"+object.title+"</td></tr>");
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
						$('tbody').append("<tr><td>"+object.id+"</td><td>"+object.title+"</td></tr>");
					});		
	 			}
	 		});
		} 
	}); 

</script>
 
<script type="text/javascript">
 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>


@endsection
@section('scripts')
<link rel="stylesheet" href="/js/parsley.min.js">
@endsection