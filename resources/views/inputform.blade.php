<div class="form-row" >
			<div class="form-group col-sm-1">
				<input class="form-check-input center" type="checkbox" value="" name={{$month}}>
			</div>
			<div class="form-group col-sm-1">
				<label for={{$month}} class="col-sm-1 col-form-label col-form-label-sm">{{$month}}</label>
			</div>
			<div class="col-sm-1">
				<input type="number" step="0.0001" class="form-control form-control-sm" name=Q{{$month}} placeholder={{$month}} value=0 equired data-parsley-type="number">
			</div>
			<div class="col-sm-1">
				<input  type="number" step="0.0001" class="form-control form-control-sm" name=h{{$month}} placeholder={{$month}} value=0 required data-parsley-type="number">
			</div>
			<div class="col-sm-1">
				<input  type="number" step="0.0001" class="form-control form-control-sm" name=t{{$month}} placeholder={{$month}} value=0 required data-parsley-type="number">
			</div>
		</div>