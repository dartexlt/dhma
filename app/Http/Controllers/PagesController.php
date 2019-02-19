<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Country;
use App\State;
use App\City;

class PagesController extends Controller
{
    public function getMA1(){
    	return view('MA1');
    }
     public function getMA2(){
        return view('MA2');
    }
     public function getMA3(){
    	return view('MA3');
    }

    public function getModel(){
        $countries = Country::pluck("name","id");
        return view('districtModel',compact('countries'));
    }
    public function getIndex(){
    	return view('home');
    }
    public function getCrud(){
        $countries = Country::pluck("name","id");
        return view('crud',compact('countries'));
    }
}
