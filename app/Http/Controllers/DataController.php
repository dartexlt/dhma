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
       // $this->validate($request, array('QJanuary'=>'required|numeric','hJanuary'=>'required|numeric','tJanuary'=>'required|numeric','QFebruary'=>'required|numeric','hFebruary'=>'required|numeric','tFebruary'=>'required|numeric','QMarch'=>'required|numeric','hMarch'=>'required|numeric','tMarch'=>'required|numeric','QApril'=>'required|numeric','hApril'=>'required|numeric','tApril'=>'required|numeric','QMay'=>'required|numeric','hMay'=>'required|numeric','tMay'=>'required|numeric','QJune'=>'required|numeric','hJune'=>'required|numeric','tJune'=>'required|numeric','QJuly'=>'required|numeric','hJuly'=>'required|numeric','tJuly'=>'required|numeric','QAugust'=>'required|numeric','hAugust'=>'required|numeric','tAugust'=>'required|numeric','QSeptember'=>'required|numeric','hSeptember'=>'required|numeric','tSeptember'=>'required|numeric','QOctober'=>'required|numeric','hOctober'=>'required|numeric','tOctober'=>'required|numeric','QNovember'=>'required|numeric','hNovember'=>'required|numeric','tNovember'=>'required|numeric','QDecember'=>'required|numeric','hDecember'=>'required|numeric','tDecember'=>'required|numeric'));
       //  $hm=new HeatModel;
       //  $hm->nhv=0;
       //  $hm->a=0;
       //  $hm->b=0;
       //  $hm->save();
       //  $month = new Month;
       //  $month->heat_model_id=$hm->id;
       //  $month->january=$request->QJanuary;
       //  $month->february=$request->QFebruary;
       //  $month->march=$request->QMarch;
       //  $month->april=$request->QApril;
       //  $month->may=$request->QMay;
       //  $month->june=$request->QJune;
       //  $month->july=$request->QJuly;
       //  $month->august=$request->QAugust;
       //  $month->september=$request->QSeptember;
       //  $month->october=$request->QOctober;
       //  $month->november=$request->QNovember;
       //  $month->december=$request->QDecember;
       //  $month->parameter_id=1;
       //  $month->save();
       //  $month = new Month;
       //  $month->heat_model_id=$hm->id;
       //  $month->january=$request->hJanuary;
       //  $month->february=$request->hFebruary;
       //  $month->march=$request->hMarch;
       //  $month->april=$request->hApril;
       //  $month->may=$request->hMay;
       //  $month->june=$request->hJune;
       //  $month->july=$request->hJuly;
       //  $month->august=$request->hAugust;
       //  $month->september=$request->hSeptember;
       //  $month->october=$request->hOctober;
       //  $month->november=$request->hNovember;
       //  $month->december=$request->hDecember;
       //  $month->parameter_id=2;
       //  $month->save();
       //  $month = new Month;
       //  $month->heat_model_id=$hm->id;
       //  $month->january=$request->tJanuary;
       //  $month->february=$request->tFebruary;
       //  $month->march=$request->tMarch;
       //  $month->april=$request->tApril;
       //  $month->may=$request->tMay;
       //  $month->june=$request->tJune;
       //  $month->july=$request->tJuly;
       //  $month->august=$request->tAugust;
       //  $month->september=$request->tSeptember;
       //  $month->october=$request->tOctober;
       //  $month->november=$request->tNovember;
       //  $month->december=$request->tDecember;
       //  $month->parameter_id=3;
       //  $month->save();
       //  $month = new Month;
       //  $month->heat_model_id=$hm->id;
       //  $month->january=$request->January;
       //  $month->february=$request->February;
       //  $month->march=$request->March;
       //  $month->april=$request->April;
       //  $month->may=$request->May;
       //  $month->june=$request->June;
       //  $month->july=$request->July;
       //  $month->august=$request->August;
       //  $month->september=$request->September;
       //  $month->october=$request->October;
       //  $month->november=$request->November;
       //  $month->december=$request->December;
       //  $month->parameter_id=10;
       //  $month->save();
       //  Session::flash('success','Data successfully saved');
       //  //return view('MA');
       //  return redirect()->route('data.show',$hm->id);
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
        $hm= DB::table("heat_models")->where("id", $id)->get();
        $hm->title=$request->title;
        $validator = \Validator::make($request->all(), array('title'=>'required', 'QJanuary'=>'required|numeric','hJanuary'=>'required|numeric','tJanuary'=>'required|numeric','QFebruary'=>'required|numeric','hFebruary'=>'required|numeric','tFebruary'=>'required|numeric','QMarch'=>'required|numeric','hMarch'=>'required|numeric','tMarch'=>'required|numeric','QApril'=>'required|numeric','hApril'=>'required|numeric','tApril'=>'required|numeric','QMay'=>'required|numeric','hMay'=>'required|numeric','tMay'=>'required|numeric','QJune'=>'required|numeric','hJune'=>'required|numeric','tJune'=>'required|numeric','QJuly'=>'required|numeric','hJuly'=>'required|numeric','tJuly'=>'required|numeric','QAugust'=>'required|numeric','hAugust'=>'required|numeric','tAugust'=>'required|numeric','QSeptember'=>'required|numeric','hSeptember'=>'required|numeric','tSeptember'=>'required|numeric','QOctober'=>'required|numeric','hOctober'=>'required|numeric','tOctober'=>'required|numeric','QNovember'=>'required|numeric','hNovember'=>'required|numeric','tNovember'=>'required|numeric','QDecember'=>'required|numeric','hDecember'=>'required|numeric','tDecember'=>'required|numeric','h83'=>'required|numeric','h82'=>'required|numeric','h8'=>'required|numeric','h5'=>'required|numeric','h0'=>'required|numeric','h_5'=>'required|numeric','h_10'=>'required|numeric','h_15'=>'required|numeric','h_20'=>'required|numeric','h_25'=>'required|numeric'));
        if ($validator->passes()){ //1 calculation method

            $Q=array($request->QJanuary,$request->QFebruary,$request->QMarch,$request->QApril, $request->QMay, $request->QJune, $request->QJuly, $request->QAugust, $request->QSeptember, $request->QOctober, $request->QNovember, $request->QDecember);
            $h= array($request->hJanuary, $request->hFebruary, $request->hMarch, $request->hApril, $request->hMay, $request->hJune, $request->hJuly, $request->hAugust, $request->hSeptember, $request->hOctober, $request->hNovember, $request->hDecember);
            $t= array($request->tJanuary, $request->tFebruary, $request->tMarch, $request->tApril, $request->tMay, $request->tJune, $request->tJuly, $request->tAugust, $request->tSeptember, $request->tOctober, $request->tNovember, $request->tDecember);
            $hnr= array($request->h83, $request->h82, $request->h8, $request->h5, $request->h0, $request->h_5, $request->h_10, $request->h_15, $request->h_20, $request->h_25);
            $N = array();
            foreach ($Q as $key => $value) {
                $N[$key]=$Q[$key]/$h[$key];
            }
            $heatingSeason=array();
            $i=0;
            foreach (array('January', 'February','March','April','May','June','July','August','September','October','November','December') as $tmp) {
                if($request->has($tmp)){
                    array_push($heatingSeason,1);
                }
                else{
                    array_push($heatingSeason,0);   
                }
            }
            $temp=0;
            $sumxy=0;
            $sumx=0;
            $sumy=0;
            $sumxx=0;
            $sumn=0;
            $Nhv=0; 
            $temp_capacity = Lava::DataTable();
            $operating_load = Lava::DataTable();
            $temp_capacity->addNumberColumn('Average Outdoor Temperature C')
               ->addNumberColumn('Heat Capacity [MW]')
               ->addNumberColumn('Trend');
            $operating_load->addNumberColumn('Operating Hours [h]')
               ->addNumberColumn('Heat Load [MW]');
            foreach ($N as $key => $value) {
                if ($heatingSeason[$key]==0){
                    $Nhv=$Nhv+$N[$key];
                    $temp=$temp+1;
                }else{
                    $sumn=$sumn+1;
                    $sumxy=$sumxy+$t[$key]*$N[$key];
                    $sumx=$sumx+$t[$key];
                    $sumy=$sumy+$N[$key];
                    $sumxx=$sumxx+$t[$key]*$t[$key];
                }
            }
            $Nhv=$Nhv/$temp;
            $a=(($sumn*$sumxy)-($sumx*$sumy))/(($sumn*$sumxx)-($sumx*$sumx));
            $b=($sumy-$a*$sumx)/$sumn;
            foreach ($t as $key => $value) {
                if ($heatingSeason[$key]==1){
                    $tt=$a*$t[$key]+$b;
                    $temp_capacity->addRow([$t[$key], $N[$key],$tt]);
                }             
            }
            $tfixed=array(8,5,0,-5,-10,-15,-20,-25);
            $Nfixed=array($Nhv,$Nhv);
            foreach ($tfixed as $key => $value) {
                $Nfixed[$key+2]=$a*$tfixed[$key]+$b;
            }
            foreach ($hnr as $key => $value) {
                $operating_load->addRow( [$hnr[$key],$Nfixed[$key]]);
            }
            $hm->nhv=$Nhv;
            $hm->a=$a;
            $hm->b=$b;
            $hm->N83=$Nfixed[0];
            $hm->N82=$Nfixed[1];
            $hm->N8=$Nfixed[2];
            $hm->N5=$Nfixed[3];
            $hm->N0=$Nfixed[4];
            $hm->N_5=$Nfixed[5];
            $hm->N_10=$Nfixed[6];
            $hm->N_15=$Nfixed[7];
            $hm->N_20=$Nfixed[8];
            $hm->N_25=$Nfixed[9];
            $hm->h83=$request->h83;
            $hm->h82=$request->h82;
            $hm->h8=$request->h8;
            $hm->h5=$request->h5;
            $hm->h0=$request->h0;
            $hm->h_5=$request->h_5;
            $hm->h_10=$request->h_10;
            $hm->h_15=$request->h_15;
            $hm->h_20=$request->h_20;
            $hm->h_25=$request->h_25;
            $hm->save();
            $month=DB::table("months")->where("heat_model_id", $hm->id)->where("parameter_id", 1)->get();
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
            $month->save();
            $month=DB::table("months")->where("heat_model_id", $hm->id)->where("parameter_id", 2)->get();
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
            $month->parameter_id=2; //Operation hours
            $month->save();
            $month=DB::table("months")->where("heat_model_id", $hm->id)->where("parameter_id", 4)->get();
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
            $month->parameter_id=4; //Average outdoor temperature
            $month->save();
            // $month=DB::table("months")->where("heat_model_id", $hm->id)->where("parameter_id", 10)->first();
            // $month->january=$heatingSeason[0];
            // $month->february=$heatingSeason[1];
            // $month->march=$heatingSeason[2];
            // $month->april=$heatingSeason[3];
            // $month->may=$heatingSeason[4];
            // $month->june=$heatingSeason[5];
            // $month->july=$heatingSeason[6];
            // $month->august=$heatingSeason[7];
            // $month->september=$heatingSeason[8];
            // $month->october=$heatingSeason[9];
            // $month->november=$heatingSeason[10];
            // $month->december=$heatingSeason[11];
            // $month->parameter_id=10;
            // $month->save();
            Session::flash('success','Data successfully updated');
            // return view('calc.result');
        }
        $validator = \Validator::make($request->all(), array('title'=>'required', 'Nave'=>'required|numeric','N2hw'=>'required|numeric','Nl'=>'required|numeric','tao'=>'required|numeric','tar'=>'required|numeric','h83'=>'required|numeric','h82'=>'required|numeric','h8'=>'required|numeric','h5'=>'required|numeric','h0'=>'required|numeric','h_5'=>'required|numeric','h_10'=>'required|numeric','h_15'=>'required|numeric','h_20'=>'required|numeric','h_25'=>'required|numeric'));
        if ($validator->passes()){
            $hnr= array($request->h83, $request->h82, $request->h8, $request->h5, $request->h0, $request->h_5, $request->h_10, $request->h_15, $request->h_20, $request->h_25);
             $tfixed=array(8,5,0,-5,-10,-15,-20.7,-25);
             $knr=array();
            foreach ($tfixed as $key => $value) {
                $knr[$key]=($request->tar-$tfixed[$key])/($request->tar-$request->tao);
            }
            $N2nr=array($request->N2hw,$request->N2hw);
            foreach ($tfixed as $key => $value) {
                $N2nr[$key+2]=$request->Nave*$knr[$key]+$request->N2hw+$request->Nl;
            }
            $operating_load = Lava::DataTable();
            $operating_load->addNumberColumn('Operating Hours [h]')
               ->addNumberColumn('Heat Load [MW]');
            foreach ($hnr as $key => $value) {
                $operating_load->addRow( [$hnr[$key],$N2nr[$key]]);
            }
            Lava::LineChart('operating_vs_load', $operating_load, ['title' => 'Operating Hours vs Heat Load', 'hAxis' => ['title' => 'Operating hours per year, [h]'],'vAxis' => ['title' => 'Heat Load, [MW]'], 'legend' => ['position' => 'top', 'alignment'=>'end'], 'lineWidth'=>1, 'pointSize'=>5, 'height'=>300]);
            $hm->Nave=$request->Nave;
            $hm->N2hw=$request->N2hw;
            $hm->Nl=$request->Nl;
            $hm->tao=$request->tao;
            $hm->tar=$request->tar;
            $hm->N83=$N2nr[0];
            $hm->N82=$N2nr[1];
            $hm->N8=$N2nr[2];
            $hm->N5=$N2nr[3];
            $hm->N0=$N2nr[4];
            $hm->N_5=$N2nr[5];
            $hm->N_10=$N2nr[6];
            $hm->N_15=$N2nr[7];
            $hm->N_20=$N2nr[8];
            $hm->N_25=$N2nr[9];
            $hm->h83=$request->h83;
            $hm->h82=$request->h82;
            $hm->h8=$request->h8;
            $hm->h5=$request->h5;
            $hm->h0=$request->h0;
            $hm->h_5=$request->h_5;
            $hm->h_10=$request->h_10;
            $hm->h_15=$request->h_15;
            $hm->h_20=$request->h_20;
            $hm->h_25=$request->h_25;
            $hm->save();
            Session::flash('success','Data successfully updated');  
        }
        $validator = \Validator::make($request->all(), array('title'=>'required', 'x1'=>'required|numeric','x2'=>'required|numeric','x3'=>'required|numeric','x4'=>'required|numeric','x5'=>'required|numeric','x6'=>'required|numeric','x7'=>'required|numeric','x8'=>'required|numeric','x9'=>'required|numeric'));
        if ($validator->passes()){
            
            $hm->x1=$request->x1;
            $hm->x2=$request->x2;
            $hm->x3=$request->x3;
            $hm->x4=$request->x4;
            $hm->x5=$request->x5;
            $hm->x6=$request->x6;
            $hm->x7=$request->x7;
            $hm->x8=$request->x8;
            $hm->x9=$request->x9;
            $hm->save();
            Session::flash('success','Data successfully updated');  
        }
       // return view('calc.result2');

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
                $mod=HeatModel::with(['countries','states','cities','months'])->get(); 
            }
            else{
                if(($request->has('city'))&&($request->city!="Select")){
                    $mod=HeatModel::with(['countries','states','cities','months'])->where("country_id",$request->country)->where("state_id",$request->state)->where("city_id",$request->city)->get(); 
                }
                else{  
                    if(($request->has('state'))&&($request->state!="Select")){
                        $mod=HeatModel::with(['countries','states','cities','months'])->where("country_id",$request->country)->where("state_id",$request->state)->get();
                    }  
                    else{
                        $mod=HeatModel::with(['countries','states','cities','months'])->where("country_id",$request->country)->get();
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
