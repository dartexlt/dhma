<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
    public function getMA(){
    	return view('multicriteriaAnalysis');
    }
    public function getModel(){
        $countries = DB::table("countries")->pluck("name","id");
        return view('districtModel',compact('countries'));
    }
    public function getIndex(){
    	return view('welcome');
    }
}
