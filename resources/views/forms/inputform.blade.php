<div class="row mt-1">
	<div class="col-sm-2 text-right">
		{{-- <input type="hidden" name={{$month}} id={{$month}} value=0> --}}
		<input class="form-check-input" type="checkbox" value=1 name={{$month}} id={{$month}}  {{$c}}>
	</div>
	<div class="col-sm-2">
		<label for={{$month}} class="col-sm-1 col-form-label col-form-label-sm">{{$month}}</label>
	</div>
	<div class="col-sm-3">
		<input type="number" step="0.01" class="form-control form-control-sm" name=Q{{$month}} placeholder={{$month}} value={{$Qval}}  data-parsley-type="number">
	</div>
	<div class="col-sm-2">
		<input  type="number" step="0.01" class="form-control form-control-sm" name=h{{$month}} placeholder={{$month}} value={{$hval}}  data-parsley-type="number">
	</div>
	<div class="col-sm-3">
		<input  type="number" step="0.01" class="form-control form-control-sm" name=t{{$month}} placeholder={{$month}} value={{$tval}}  data-parsley-type="number">
	</div>
</div>