@extends('main')
@section('title', 'Multicriteria Analysis')
@section('stylesheets')
<link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('content')
<form method="post" action="{{url('calcMA')}}" data-parsley-validate>
	@csrf
	<div class="container">
			{{csrf_field()}}
		<div class="row" >
              <button type="submit" class="btn btn-primary btn-md">Calculate</button>
		</div>
	</div>
</form>
@endsection
@section('scripts')
<link rel="stylesheet" href="/js/parsley.min.js">
@endsection