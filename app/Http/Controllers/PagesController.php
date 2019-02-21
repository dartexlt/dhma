<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Country;
use App\State;
use App\City;

class PagesController extends Controller
{
    public function getHeatLoad1(){
    	return view('HLcalculator1');
    }
     public function getHeatLoad2(){
        return view('HLcalculator2');
    }
     public function getRiL(){
    	return view('RiLcalculator');
    }
    public function getPEF(){
        return view('PEFcalculator');
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
