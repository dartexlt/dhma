<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;
use DB;
class DropdownController extends Controller
{
    
        public function index()
        {
            $countries = Country::pluck("name","id");
            return view('countrySelector',compact('countries'));
        }

        public function getStateList(Request $request)
        {
            $states = State::where("country_id",$request->country_id)
            ->pluck("name","id");
            return response()->json($states);
        }

        public function getCityList(Request $request)
        {
            $cities = City::where("state_id",$request->state_id)
            ->pluck("name","id");
            return response()->json($cities);
        }
}