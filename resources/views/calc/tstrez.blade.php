@extends('main')
@section('title', 'Home')
@section('content')

 @foreach ($heatingSeason as $T)
   	<h1>{{$T}}</h1>
@endforeach 
{{-- <h1>{{$heatSeason}}</h1> --}}
@endsection
