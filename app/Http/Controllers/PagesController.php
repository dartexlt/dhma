<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getMA1(){
    	return view('MA1');
    }
     public function getMA2(){
    	return view('MA2');
    }
    public function getIndex(){
    	return view('welcome');
    }
}
