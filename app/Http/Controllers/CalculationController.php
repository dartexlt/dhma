<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lava;
use Khill\Lavacharts\Lavacharts;
use App\Month;
use App\HeatModel;
use Session;
use DB;

class CalculationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculate(Request $request)
    {
       $this->validate($request, array('QJanuary'=>'required|numeric','hJanuary'=>'required|numeric','tJanuary'=>'required|numeric','QFebruary'=>'required|numeric','hFebruary'=>'required|numeric','tFebruary'=>'required|numeric','QMarch'=>'required|numeric','hMarch'=>'required|numeric','tMarch'=>'required|numeric','QApril'=>'required|numeric','hApril'=>'required|numeric','tApril'=>'required|numeric','QMay'=>'required|numeric','hMay'=>'required|numeric','tMay'=>'required|numeric','QJune'=>'required|numeric','hJune'=>'required|numeric','tJune'=>'required|numeric','QJuly'=>'required|numeric','hJuly'=>'required|numeric','tJuly'=>'required|numeric','QAugust'=>'required|numeric','hAugust'=>'required|numeric','tAugust'=>'required|numeric','QSeptember'=>'required|numeric','hSeptember'=>'required|numeric','tSeptember'=>'required|numeric','QOctober'=>'required|numeric','hOctober'=>'required|numeric','tOctober'=>'required|numeric','QNovember'=>'required|numeric','hNovember'=>'required|numeric','tNovember'=>'required|numeric','QDecember'=>'required|numeric','hDecember'=>'required|numeric','tDecember'=>'required|numeric'));
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
                $heatingSeason[$i]=(int)$request->$tmp;                
                $i++;
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
  //       Lava::LineChart('temperature_vs_capacity', $temp_capacity, [
  //       	'title' => 'Temperature vs Heat Capacity ',
  //       	'hAxis' => ['title' => 'Average outdoor temperature, [°C]'],
  //       	'vAxis' => ['title' => 'Heat Capacity, [MW]'], 
  //       	'legend' => ['position' => 'top', 'alignment'=>'end'], 
  //       	'height'=>300,
  //       	'series' => [0=> ['type' => 'line','lineWidth'=>0,'pointSize'=>5], 1 => ['type' => 'line','lineWidth'=>1,'pointSize'=>0 ]]
  //       ]);
		// Lava::LineChart('operating_vs_load', $operating_load, ['title' => 'Operating Hours vs Heat Load', 'hAxis' => ['title' => 'Operating hours per year, [h]'],'vAxis' => ['title' => 'Heat Load, [MW]'], 'legend' => ['position' => 'top', 'alignment'=>'end'], 'lineWidth'=>1, 'pointSize'=>5, 'height'=>300]);

		/*$arr = array_add($request, 'Nhv'=>$Nhv);*/
        /*return redirect()->route('calc.result',compact('Q','h','t','N','Nhv'));*/
        //return view('calc.result',compact('Q','h','t','N','Nhv','a','b','Nfixed'));
        
        //return view('calc.result');

        return array('data1' => $temp_capacity->toJson(),'data2' => $operating_load->toJson());
      
    }


 public function calculate2(Request $request)
    {
       $this->validate($request, array());
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

		/*$arr = array_add($request, 'Nhv'=>$Nhv);*/
        /*return redirect()->route('calc.result',compact('Q','h','t','N','Nhv'));*/
        //return view('calc.result',compact('Q','h','t','N','Nhv','a','b','Nfixed'));
        //return view('calc.result2');
        //return $operating_load->toJson();
        return $operating_load->toJson();
      
    }
   

public function calculate3(Request $request)
    {
       $this->validate($request, array());
        $Q=array($request->QJanuary,$request->QFebruary,$request->QMarch,$request->QApril, $request->QMay, $request->QJune, $request->QJuly, $request->QAugust, $request->QSeptember, $request->QOctober, $request->QNovember, $request->QDecember);
        $Q2=array($request->Q2January,$request->Q2February,$request->Q2March,$request->Q2April, $request->Q2May, $request->Q2June, $request->Q2July, $request->Q2August, $request->Q2September, $request->Q2October, $request->Q2November, $request->Q2December);
        $h= array($request->hJanuary, $request->hFebruary, $request->hMarch, $request->hApril, $request->hMay, $request->hJune, $request->hJuly, $request->hAugust, $request->hSeptember, $request->hOctober, $request->hNovember, $request->hDecember);


        $Edel=0;
        $Eloss=0;
        $Q3=array();
        foreach ($Q as $key => $value) {
            $Q3[$key]=$Q[$key]-$Q2[$key];
            $Edel=$Edel+$Q2[$key];
            $Eloss=$Eloss+$Q3[$key];
        }
        $Eaux=15;
        $Ril=$this->RiL($Eloss,$Eaux,$Edel);
       //  return view('calc.testResult',compact('Ril'));
      // return view('calc.result2');
      
    }


public function calculateMA(Request $request)
    {
        //Multicriteria Analysis
        //test array
        $data = array
            (
            array(1.278,0.44,90.00,0.00,0.00,150.01,0.34,15.30,41),
            array(1.353,0.44,90.00,100.00,0.00,150.01,0.00,15.30,20),
            array(1.082,0.44,90.00,100.00,0.00,150.01,0.00,15.30,10),
            array(1.268,0.51,90.00,0.00,0.00,141.01,0.33,17.32,40),
            array(1.342,0.51,90.00,100.00,0.00,141.01,0.00,17.32,20)//,
            // array(1.074,0.51,90.00,100.00,0.00,141.01,0.00,17.32,10),
            // array(1.203,0.60,90.00,0.00,0.00,83.01,0.32,23.09,40),
            // array(1.274,0.60,90.00,100.00,0.00,83.01,0.00,23.09,20),
            // array(1.019,0.60,90.00,100.00,0.00,83.01,0.00,23.09,10),
            // array(1.358,0.44,60.00,0.00,1.00,222.11,0.36,12.70,40),
            // array(1.438,0.44,58.00,100.00,1.00,222.11,0.00,12.70,20),
            // array(1.150,0.44,58.00,100.00,1.00,222.11,0.00,12.70,10),
            // array(1.343,0.51,56.00,0.00,1.00,208.78,0.35,14.43,40),
            // array(1.422,0.51,56.00,100.00,1.00,208.78,0.00,14.43,20),
            // array(1.138,0.51,56.00,100.00,1.00,208.78,0.00,14.43,10),
            // array(1.248,0.60,55.00,0.00,1.00,122.90,0.33,20.21,40),
            // array(1.321,0.60,55.00,100.00,1.00,122.90,0.00,20.21,20),
            // array(1.057,0.60,55.00,100.00,1.00,122.90,0.00,20.21,10)
        );
        $w=array(1/9,1/9,1/9,1/9,1/9,1/9,1/9,1/9,1/9);
        $m=array(1,0,1,0,0,1,1,1,1); //minimisation or maximisation
        $temp=$this->topsis($data,$w,$m);
        asort($temp);

        $bar = Lava::DataTable();
        $bar->addStringColumn('Name')
           ->addNumberColumn('Rank');
        foreach ($temp as $key => $value) {
            $bar->addRow([$key+1,$value]);
        }
        Lava::ColumnChart('multicriteria', $bar, ['title' => 'Multicriteria ranking', 'hAxis' => ['title' => 'Region'],'vAxis' => ['title' => 'Rank'], 'height'=>800]);
        return view('calc.testResult');
      
    }


    public function topsis($matrix, $criteriaWeights,$maximisation)
    {
        $row=count($matrix);
        $col = count($matrix[0]);
        if (($row>1)&&($col>1)&& (count($criteriaWeights)==$col)&& (count($maximisation)==$col)){
            $min=array();
            $max=array();   
            for ($c = 0; $c < $col; $c++) {
                $min[$c]=min(array_column($matrix, $c));
                $max[$c]=max(array_column($matrix, $c));
            }
            // matrix normalization and weighting
            for ($r= 0; $r< $row; $r++) {
                for ($c = 0; $c < $col; $c++) {
                    $division=0;
                    if (($max[$c]-$min[$c])==0){
                        $division=1;
                    }
                    else{
                        $division=$max[$c]-$min[$c];
                    }
                    if ($maximisation[$c]==1){
                        $matrix[$r][$c]=(($max[$c]-$matrix[$r][$c])/$division)*$criteriaWeights[$c];
                    }
                    else{
                        $matrix[$r][$c]=(($matrix[$r][$c]-$min[$c])/$division)*$criteriaWeights[$c];   
                    }
                }
            } 
            for ($c = 0; $c < $col; $c++) {
                $min[$c]=min(array_column($matrix, $c));
                $max[$c]=max(array_column($matrix, $c));
            }
            $splus=array();
            $sminus=array();
            for ($r= 0; $r< $row; $r++) {
                $splus[$r]=0;
                $sminus[$r]=0;
                for ($c = 0; $c < $col; $c++) {
                        $splus[$r]=$splus[$r]+pow($matrix[$r][$c]-$max[$c],2);
                        $sminus[$r]=$sminus[$r]+pow($matrix[$r][$c]-$min[$c],2);   
                }
                $splus[$r]=sqrt($splus[$r]);
                $sminus[$r]=sqrt($sminus[$r]);
            }
            $C=array();
            for ($r = 0; $r < $row; $r++) {
                $C[$r]=$sminus[$r]/($sminus[$r]+$splus[$r]);
            }
            return $C;
        }
    }
      
    public function RiL($Eloss, $Eaux, $Edel)
    {
        $Ril=($Eloss+$Eaux)/$Edel;
        return $Ril;   
    }

    
/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function getResult($arr){
    	return view('calc.result')->withArr($arr);;
    }




public function model(Request $request)
    {
       $countries = DB::table("countries")->pluck("name","id");
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
                $heatingSeason[$i]=(int)$request->$tmp;                
                $i++;
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
            Lava::LineChart('temperature_vs_capacity', $temp_capacity, [
                'title' => 'Temperature vs Heat Capacity ',
                'hAxis' => ['title' => 'Average outdoor temperature, [°C]'],
                'vAxis' => ['title' => 'Heat Capacity, [MW]'], 
                'legend' => ['position' => 'top', 'alignment'=>'end'], 
                'height'=>300,
                'series' => [0=> ['type' => 'line','lineWidth'=>0,'pointSize'=>5], 1 => ['type' => 'line','lineWidth'=>1,'pointSize'=>0 ]]
            ]);
            Lava::LineChart('operating_vs_load', $operating_load, ['title' => 'Operating Hours vs Heat Load', 'hAxis' => ['title' => 'Operating hours per year, [h]'],'vAxis' => ['title' => 'Heat Load, [MW]'], 'legend' => ['position' => 'top', 'alignment'=>'end'], 'lineWidth'=>1, 'pointSize'=>5, 'height'=>300]);

            $hm=new HeatModel;
            $hm->country_id=$request->country;
            $hm->state_id=$request->state;
            $hm->city_id=$request->city;
            $hm->title=$request->title;
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
            $month->parameter_id=1; //Transferred heat to the network
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
            $month->parameter_id=2; //Operation hours
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
            $month->parameter_id=4; //Average outdoor temperature
            $month->save();
            Session::flash('success','Data successfully saved');
             return view('calc.result');
        }
        else{
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

                    $hm=new HeatModel;
                    $hm->country_id=$request->country;
                    $hm->state_id=$request->state;
                    $hm->city_id=$request->city;
                    $hm->title=$request->title;
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
                    Session::flash('success','Data successfully saved');
                return view('calc.result2');
            }
        }
    }     

public function modelSaveDB(Request $request)
    {
        $countries = DB::table("countries")->pluck("name","id");
        $hm=new HeatModel;
        $hm->country_id=$request->country;
        $hm->state_id=$request->state;
        $hm->city_id=$request->city;
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
                $heatingSeason[$i]=(int)$request->$tmp;                
                $i++;
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
            $month->parameter_id=1; //Transferred heat to the network
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
            $month->parameter_id=2; //Operation hours
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
            $month->parameter_id=4; //Average outdoor temperature
            $month->save();
            Session::flash('success','Data successfully saved');
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
            Session::flash('success','Data successfully saved');  
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
            Session::flash('success','Data successfully saved');  
        }
        return view('calc.result2');
    }     


}
