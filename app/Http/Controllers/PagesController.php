<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getMA(){
    	return view('MA');
    }
    public function getIndex(){
    	return view('welcome');
    }
}
