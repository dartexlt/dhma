<div class="form-row" >
			<div class="form-group col-sm-2">
				<label for={{$month}} class="col-sm-1 col-form-label col-form-label-sm">{{$month}}</label>
			</div>
			<div class="col-sm-3">
				<input type="number" step="0.0001" class="form-control form-control-sm" name=Q2{{$month}} placeholder={{$month}} value={{$Q2}} equired data-parsley-type="number">
			</div>
			<div class="col-sm-3">
				<input type="number" step="0.0001" class="form-control form-control-sm" name=Q{{$month}} placeholder={{$month}} value={{$Q}} equired data-parsley-type="number">
			</div>
			<div class="col-sm-3">
				<input  type="number" step="0.0001" class="form-control form-control-sm" name=h{{$month}} placeholder={{$month}} value={{$h}} required data-parsley-type="number">
			</div>
		</div>