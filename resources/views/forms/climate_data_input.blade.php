<div class="row mt-1" >
	<div class="col-sm-6 text-right">
		<label for=var{{$title}} class="col-sm-1 col-form-label col-form-label-sm">{{$title}}</label>
	</div>
	<div class="col-sm-6">
		<input type="number" step="0.01" class="form-control form-control-sm" name={{$title}} placeholder={{$title}} value={{$value}} required data-parsley-type="number">
	</div>
</div>