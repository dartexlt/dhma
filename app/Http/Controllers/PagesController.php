<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Lava;
use Khill\Lavacharts\Lavacharts;
use App\Country;
use App\State;
use App\City;

class PagesController extends Controller
{
    public function getMA1(){


        $temp_capacity = Lava::DataTable();
        $operating_load = Lava::DataTable();
        $temp_capacity->addNumberColumn('Average Outdoor Temperature C')
           ->addNumberColumn('Heat Capacity [MW]')
           ->addNumberColumn('Trend');
        $operating_load->addNumberColumn('Operating Hours [h]')
           ->addNumberColumn('Heat Load [MW]');    
        Lava::LineChart('temperature_vs_capacity', $temp_capacity, [
            'title' => 'Temperature vs Heat Capacity ',
            'hAxis' => ['title' => 'Average outdoor temperature, [°C]'],
            'vAxis' => ['title' => 'Heat Capacity, [MW]'], 
            'legend' => ['position' => 'top', 'alignment'=>'end'], 
            'height'=>300,
            'series' => [0=> ['type' => 'line','lineWidth'=>0,'pointSize'=>5], 1 => ['type' => 'line','lineWidth'=>1,'pointSize'=>0 ]]
        ]);
        Lava::LineChart('operating_vs_load', $operating_load, ['title' => 'Operating Hours vs Heat Load', 'hAxis' => ['title' => 'Operating hours per year, [h]'],'vAxis' => ['title' => 'Heat Load, [MW]'], 'legend' => ['position' => 'top', 'alignment'=>'end'], 'lineWidth'=>1, 'pointSize'=>5, 'height'=>300]);
    	return view('MA1',compact('temperature_vs_capacity','operating_vs_load'));
    }
     public function getMA2(){
        $operating_load = Lava::DataTable();
        $operating_load->addNumberColumn('Operating Hours [h]')
           ->addNumberColumn('Heat Load [MW]');
        Lava::LineChart('operating_vs_load', $operating_load, ['title' => 'Operating Hours vs Heat Load', 'hAxis' => ['title' => 'Operating hours per year, [h]'],'vAxis' => ['title' => 'Heat Load, [MW]'], 'legend' => ['position' => 'top', 'alignment'=>'end'], 'lineWidth'=>1, 'pointSize'=>5, 'height'=>300]);
    	return view('MA2',compact('operating_vs_load'));
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
