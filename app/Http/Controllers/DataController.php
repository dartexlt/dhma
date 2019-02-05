<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lava;
use Khill\Lavacharts\Lavacharts;
use App\Month;
use App\HeatModel;
use Session;
use DB;


class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = DB::table("countries")->pluck("name","id");
        $operating_load = Lava::DataTable();
        $operating_load->addNumberColumn('Operating Hours [h]')
           ->addNumberColumn('Heat Load [MW]');
        Lava::LineChart('operating_vs_load', $operating_load, ['title' => 'Operating Hours vs Heat Load', 'hAxis' => ['title' => 'Operating hours per year, [h]'],'vAxis' => ['title' => 'Heat Load, [MW]'], 'legend' => ['position' => 'top', 'alignment'=>'end'], 'lineWidth'=>1, 'pointSize'=>5, 'height'=>300]);
        $bar = Lava::DataTable();
        $bar->addStringColumn('Name')
           ->addNumberColumn('Rank');
        Lava::ColumnChart('multicriteria', $bar, ['title' => 'Multicriteria ranking', 'hAxis' => ['title' => 'Region'],'vAxis' => ['title' => 'Rank'], 'height'=>300]);
        return view('search',compact('countries','operating_vs_load','multicriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('MA');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, array('QJanuary'=>'required|numeric','hJanuary'=>'required|numeric','tJanuary'=>'required|numeric','QFebruary'=>'required|numeric','hFebruary'=>'required|numeric','tFebruary'=>'required|numeric','QMarch'=>'required|numeric','hMarch'=>'required|numeric','tMarch'=>'required|numeric','QApril'=>'required|numeric','hApril'=>'required|numeric','tApril'=>'required|numeric','QMay'=>'required|numeric','hMay'=>'required|numeric','tMay'=>'required|numeric','QJune'=>'required|numeric','hJune'=>'required|numeric','tJune'=>'required|numeric','QJuly'=>'required|numeric','hJuly'=>'required|numeric','tJuly'=>'required|numeric','QAugust'=>'required|numeric','hAugust'=>'required|numeric','tAugust'=>'required|numeric','QSeptember'=>'required|numeric','hSeptember'=>'required|numeric','tSeptember'=>'required|numeric','QOctober'=>'required|numeric','hOctober'=>'required|numeric','tOctober'=>'required|numeric','QNovember'=>'required|numeric','hNovember'=>'required|numeric','tNovember'=>'required|numeric','QDecember'=>'required|numeric','hDecember'=>'required|numeric','tDecember'=>'required|numeric'));
        $hm=new HeatModel;
        $hm->nhv=0;
        $hm->a=0;
        $hm->b=0;
        $hm->save();
        $month = new Month;
        $month->heat_model_id=$hm->id;
        $month->january=$request->QJanuary;
        $month->february=$request->QFebruary;
        $month->march=$request->QMarch;
        $month->april=$request->QApril;
        $month->may=$request->QMay;
        $month->june=$request->QJune;
        $month->july=$request->QJuly;
        $month->august=$request->QAugust;
        $month->september=$request->QSeptember;
        $month->october=$request->QOctober;
        $month->november=$request->QNovember;
        $month->december=$request->QDecember;
        $month->parameter_id=1;
        $month->save();
        $month = new Month;
        $month->heat_model_id=$hm->id;
        $month->january=$request->hJanuary;
        $month->february=$request->hFebruary;
        $month->march=$request->hMarch;
        $month->april=$request->hApril;
        $month->may=$request->hMay;
        $month->june=$request->hJune;
        $month->july=$request->hJuly;
        $month->august=$request->hAugust;
        $month->september=$request->hSeptember;
        $month->october=$request->hOctober;
        $month->november=$request->hNovember;
        $month->december=$request->hDecember;
        $month->parameter_id=2;
        $month->save();
        $month = new Month;
        $month->heat_model_id=$hm->id;
        $month->january=$request->tJanuary;
        $month->february=$request->tFebruary;
        $month->march=$request->tMarch;
        $month->april=$request->tApril;
        $month->may=$request->tMay;
        $month->june=$request->tJune;
        $month->july=$request->tJuly;
        $month->august=$request->tAugust;
        $month->september=$request->tSeptember;
        $month->october=$request->tOctober;
        $month->november=$request->tNovember;
        $month->december=$request->tDecember;
        $month->parameter_id=3;
        $month->save();
        Session::flash('success','Data successfully saved');
        //return view('MA');
        return redirect()->route('data.show',$hm->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model= HeatModel::find($id);
        return view('result')->withModel($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function search(Request $request)
    {
        if($request->ajax()){
            $output="";
            if($request->has('all')){
                $mod=HeatModel::with(['countries','states','cities'])->get(); 
            }
            else{
                if(($request->has('city'))&&($request->city!="Select")){
                    $mod=HeatModel::with(['countries','states','cities'])->where("country_id",$request->country)->where("state_id",$request->state)->where("city_id",$request->city)->get(); 
                }
                else{  
                    if(($request->has('state'))&&($request->state!="Select")){
                        $mod=HeatModel::with(['countries','states','cities'])->where("country_id",$request->country)->where("state_id",$request->state)->get();
                    }  
                    else{
                        $mod=HeatModel::with(['countries','states','cities'])->where("country_id",$request->country)->get();
                    }
                }
            }
            return response()->json($mod);
        
        }
    } 
    public function getCharts(Request $request)
    {
        //if($request->ajax()){
            $mod=DB::table("heat_models")->whereIn("id",$request->ids)->get(); 
            $operating_load = Lava::DataTable();
            $operating_load->addNumberColumn('Operating Hours [h]');
            $d1=array($mod[0]->h83);
            $d2=array($mod[0]->h82);
            $d3=array($mod[0]->h8);
            $d4=array($mod[0]->h5);
            $d5=array($mod[0]->h0);
            $d6=array($mod[0]->h_5);
            $d7=array($mod[0]->h_10);
            $d8=array($mod[0]->h_15);
            $d9=array($mod[0]->h_20);
            $d10=array($mod[0]->h_25);
            $data = array();
            $titles=array();
            foreach ($mod as $key => $value) {
                array_push($data, array($value->x1,$value->x2,$value->x3,$value->x4,$value->x5,$value->x6,$value->x7,$value->x8,$value->x9));
                $operating_load->addNumberColumn($value->title);
                array_push($titles,$value->title);
                array_push($d1,$value->N83);
                array_push($d2,$value->N82);
                array_push($d3,$value->N8);
                array_push($d4,$value->N5);
                array_push($d5,$value->N0);
                array_push($d6,$value->N_5);
                array_push($d7,$value->N_10);
                array_push($d8,$value->N_15);
                array_push($d9,$value->N_20);
                array_push($d10,$value->N_25);

            }
           $operating_load->addRow($d1);
           $operating_load->addRow($d2);
           $operating_load->addRow($d3);
           $operating_load->addRow($d4);
           $operating_load->addRow($d5);
           $operating_load->addRow($d6);
           $operating_load->addRow($d7);
           $operating_load->addRow($d8);
           $operating_load->addRow($d9);
           $operating_load->addRow($d10);
       // }
        $w=array(1/9,1/9,1/9,1/9,1/9,1/9,1/9,1/9,1/9);
        $m=array(1,0,1,0,0,1,1,1,1); //minimisation or maximisation
        $temp=app('App\Http\Controllers\CalculationController')->topsis($data,$w,$m);
        asort($temp);
        $bar = Lava::DataTable();
        $bar->addStringColumn('Name')
           ->addNumberColumn('Rank');
        foreach ($temp as $key => $value) {
            $bar->addRow([$titles[$key],$value]);
        }
        return array('data1' => $operating_load->toJson(),'data2' => $bar->toJson());
    
    }

}
