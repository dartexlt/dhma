<div class="row mt-1" >
	@if(($title =='h83')||($title =='h82'))         
    	<div class="col-sm-8">
			<label for=var{{$title}} class="col-sm-12 col-form-label col-form-label-sm">{{$label}}</label>
		</div>
		<div class="col-sm-4">
			<input type="number" step="0.01" class="form-control form-control-sm" name={{$title}} placeholder={{$title}} value={{$value}} required data-parsley-type="number">
		</div>
	@else
		<div class="col-sm-9">
			<label for=var{{$title}} class="col-sm-12 col-form-label col-form-label-sm">Total Operating Hours at <
					<input class="form-control-sm" name="fixed{{$title}}" placeholder="e.g. {{$t}}" value={{$t}} required data-parsley-type="number" size="3">
			°C [h] </label>
		</div>
		<div class="col-sm-3">
			<input type="number" step="0.01" class="form-control form-control-sm" name={{$title}} placeholder={{$title}} value={{$value}} required data-parsley-type="number">
		</div>
	@endif	
</div>