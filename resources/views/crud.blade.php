@extends('main')
@section('title', 'Edit Data Entries')
@section('stylesheets')
	<link rel="stylesheet" href="/css/parsley.css">
	<style type="text/css">
    body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		background: #435d7d;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {    
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 1000px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}	
	<script type="text/javascript">
		$(document).ready(function(){
		// Activate tooltip
		$('[data-toggle="tooltip"]').tooltip();
	
			// Select/Deselect checkboxes
			var checkbox = $('table tbody input[type="checkbox"]');
			$("#selectAll").click(function(){
				if(this.checked){
					checkbox.each(function(){
						this.checked = true;                        
					});
				} else{
					checkbox.each(function(){
						this.checked = false;                        
					});
				} 
			});
			checkbox.click(function(){
				if(!this.checked){
					$("#selectAll").prop("checked", false);
				}
			});
		});
	</script>
</style>
@endsection
@section('content')


<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
					<h2>Manage <b>Models</b></h2>
				</div>
            </div>
        </div>
        @csrf
		@include('forms.countrySelector')
        <table id="table1" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Country/State/City</th>
				 	<th>Model Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
			</tbody>
        </table>
		<div class="clearfix">
            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
            <ul class="pagination">
                <li class="page-item disabled"><a href="#">Previous</a></li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">4</a></li>
                <li class="page-item"><a href="#" class="page-link">5</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="editModel" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="f1" action="{{url('model')}}" data-parsley-validate>
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Edit Model</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class ="row">
						<label for=title class="col-form-label col-form-label-sm">Model name</label>
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
						<div class="col-sm-5">
							<div class="row mt-2">
								<div class="col-sm-12 text-center">
									<label>Total Operating Hours in a Year at Apropriate Outdor Temperatures:</label>
								</div>
							</div>
							@include('forms.climate_data_input',['title' => 'h83','label' => 'Total Hours in a Year [h]','value'=>'8760'])
							@include('forms.climate_data_input',['title' => 'h82','label' => 'Total Hours in a Heating Season [h]','value'=>'4872'])
							@include('forms.climate_data_input',['title' => 'h8','label' => 'Total Operating Hours at <8°C [h]','value'=>'4872'])
							@include('forms.climate_data_input',['title' => 'h5','label' => 'Total Operating Hours at <5°C [h]','value'=>'3989'])
							@include('forms.climate_data_input',['title' => 'h0','label' => 'Total Operating Hours at <0°C [h]','value'=>'2835'])
							@include('forms.climate_data_input',['title' => 'h_5','label' => 'Total Operating Hours at <-5°C [h]','value'=>'1050'])
							@include('forms.climate_data_input',['title' => 'h_10','label' => 'Total Operating Hours at <-10°C [h]','value'=>'518'])
							@include('forms.climate_data_input',['title' => 'h_15','label' => 'Total Operating Hours at <-15°C [h]','value'=>'305'])
							@include('forms.climate_data_input',['title' => 'h_20','label' => 'Total Operating Hours at <-20°C [h]','value'=>'104'])
							@include('forms.climate_data_input',['title' => 'h_25','label' => 'Total Operating Hours at <-25°C [h]','value'=>'14'])
						</div>
						<div class="col-sm-7">
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
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteModel" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>   

<script type="text/javascript">
	var datajson=null;
	$(window).on( "load", function() {
		$.ajax({
    		type : "GET",
			url : "{{URL::to('search')}}",
			data:{"all":0},
 			success:function(data){
 				
 				$('tbody').empty();
 				data.forEach(function(object) {
					$('tbody').append("<tr><td>"+object.countries.name+"/"+object.states.name+"/"+object.cities.name+"</td><td>"+object.title+"</td><td>\
                        <a href=\"#editModel\" class=\"edit\" data-toggle=\"modal\" value="+object.id+"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>\
                        <a href=\"#deleteModel\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a></td></tr>");
				datajson=object;
				});
					
			}
 		});

	});
	$('[title="Edit"]').click(function() {
		$("input[name='title']" ).val("aaaaaaaaaaaaaaaaaaaa");
		console.log("datajson");
	});

	$('#country').change(function(){
    	var countryID = $(this).val();    
	    if(countryID){
	    	$.ajax({
	    		type : "GET",
				url : "{{URL::to('search')}}",
				data:{"country":countryID},
	 			success:function(data){
	 				datajson=data;
	 				$('tbody').empty();
	 				data.forEach(function(object) {
					$('tbody').append("<tr><td>"+object.countries.name+"/"+object.states.name+"/"+object.cities.name+"</td><td>"+object.title+"</td><td>\
                        <a href=\"#editModel\" class=\"edit\" data-toggle=\"modal\" value="+object.id+"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>\
                        <a href=\"#deleteModel\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a></td></tr>");
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
	 				datajson=data;
					$('tbody').empty();
					data.forEach(function(object) {
					$('tbody').append("<tr><td>"+object.countries.name+"/"+object.states.name+"/"+object.cities.name+"</td><td>"+object.title+"</td><td>\
                        <a href=\"#editModel\" class=\"edit\" data-toggle=\"modal\" value="+object.id+"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>\
                        <a href=\"#deleteModel\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a></td></tr>");

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
	 				datajson=data;
	 				$('tbody').empty();
	 				data.forEach(function(object) {
					$('tbody').append("<tr><td>"+object.countries.name+"/"+object.states.name+"/"+object.cities.name+"</td><td>"+object.title+"</td><td>\
                        <a href=\"#editModel\" class=\"edit\" data-toggle=\"modal\" value="+object.id+"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>\
                        <a href=\"#deleteModel\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a></td></tr>");
					});		
	 			}
	 		});
		} 
	});   
</script>                         		                            

@endsection