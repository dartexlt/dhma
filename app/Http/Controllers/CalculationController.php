<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Month;
use App\HeatModel;
use App\Country;
use App\State;
use App\City;
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
    public function calcHL1(Request $request)
    {
       $this->validate($request, array('QJanuary'=>'required|numeric','hJanuary'=>'required|numeric','tJanuary'=>'required|numeric','QFebruary'=>'required|numeric','hFebruary'=>'required|numeric','tFebruary'=>'required|numeric','QMarch'=>'required|numeric','hMarch'=>'required|numeric','tMarch'=>'required|numeric','QApril'=>'required|numeric','hApril'=>'required|numeric','tApril'=>'required|numeric','QMay'=>'required|numeric','hMay'=>'required|numeric','tMay'=>'required|numeric','QJune'=>'required|numeric','hJune'=>'required|numeric','tJune'=>'required|numeric','QJuly'=>'required|numeric','hJuly'=>'required|numeric','tJuly'=>'required|numeric','QAugust'=>'required|numeric','hAugust'=>'required|numeric','tAugust'=>'required|numeric','QSeptember'=>'required|numeric','hSeptember'=>'required|numeric','tSeptember'=>'required|numeric','QOctober'=>'required|numeric','hOctober'=>'required|numeric','tOctober'=>'required|numeric','QNovember'=>'required|numeric','hNovember'=>'required|numeric','tNovember'=>'required|numeric','QDecember'=>'required|numeric','hDecember'=>'required|numeric','tDecember'=>'required|numeric','fixedh8'=>'required|numeric','fixedh5'=>'required|numeric','fixedh0'=>'required|numeric','fixedh_5'=>'required|numeric','fixedh_10'=>'required|numeric','fixedh_15'=>'required|numeric','fixedh_20'=>'required|numeric','fixedh_25'=>'required|numeric'));
        $Q=array($request->QJanuary,$request->QFebruary,$request->QMarch,$request->QApril, $request->QMay, $request->QJune, $request->QJuly, $request->QAugust, $request->QSeptember, $request->QOctober, $request->QNovember, $request->QDecember);
        $h= array($request->hJanuary, $request->hFebruary, $request->hMarch, $request->hApril, $request->hMay, $request->hJune, $request->hJuly, $request->hAugust, $request->hSeptember, $request->hOctober, $request->hNovember, $request->hDecember);
        
       $t= array($request->tJanuary, $request->tFebruary, $request->tMarch, $request->tApril, $request->tMay, $request->tJune, $request->tJuly, $request->tAugust, $request->tSeptember, $request->tOctober, $request->tNovember, $request->tDecember);
        $hnr= array($request->h83, $request->h82, $request->h8, $request->h5, $request->h0, $request->h_5, $request->h_10, $request->h_15, $request->h_20, $request->h_25);
        $N = array();
        foreach ($Q as $key => $value) {
        	$N[$key]=$Q[$key]/$h[$key];
        }
        foreach ($t as $key => $value) {
            settype($t[$key],"float");
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
		$temp_capacity[0]=['Average Outdoor Temperature C','Heat Capacity [MW]'];
        $operating_load[0]=['Operating Hours [h]','Heat Load [MW]'];
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
        $index=1;
        foreach ($t as $key => $value) {
        	if ($heatingSeason[$key]==1){
        		$tt=$a*$t[$key]+$b;
        		$temp_capacity[$index]=[$t[$key], $N[$key]];
                $index++;
        	}
        	
        }


        $tfixed=array($request->fixedh8, $request->fixedh5, $request->fixedh0, $request->fixedh_5, $request->fixedh_10, $request->fixedh_15, $request->fixedh_20,$request->fixedh_25);
		$Nfixed=array($Nhv,$Nhv);
		foreach ($tfixed as $key => $value) {
        	$Nfixed[$key+2]=$a*$tfixed[$key]+$b;
        }
        foreach ($hnr as $key => $value) {
            settype($hnr[$key],"float");
			$operating_load[$key+1]=[$hnr[$key],$Nfixed[$key]];
        }
        return array('tem_cap' => json_encode($temp_capacity),'load' => json_encode($operating_load));
      
    }


 public function calcHL2(Request $request)
    {
       $this->validate($request, array('Nave'=>'required|numeric','N2hw'=>'required|numeric','Nl'=>'required|numeric','tao'=>'required|numeric','tar'=>'required|numeric','h83'=>'required|numeric','h82'=>'required|numeric','h8'=>'required|numeric','h5'=>'required|numeric','h0'=>'required|numeric','h_5'=>'required|numeric','h_10'=>'required|numeric','h_15'=>'required|numeric','h_20'=>'required|numeric','h_25'=>'required|numeric','fixedh8'=>'required|numeric','fixedh5'=>'required|numeric','fixedh0'=>'required|numeric','fixedh_5'=>'required|numeric','fixedh_10'=>'required|numeric','fixedh_15'=>'required|numeric','fixedh_20'=>'required|numeric','fixedh_25'=>'required|numeric'));
        $hnr= array($request->h83, $request->h82, $request->h8, $request->h5, $request->h0, $request->h_5, $request->h_10, $request->h_15, $request->h_20, $request->h_25);
         $tfixed=array($request->fixedh8, $request->fixedh5, $request->fixedh0, $request->fixedh_5, $request->fixedh_10, $request->fixedh_15, $request->fixedh_20,$request->fixedh_25);
         $knr=array();
		foreach ($tfixed as $key => $value) {
        	$knr[$key]=($request->tar-$tfixed[$key])/($request->tar-$request->tao);
        }
        $N2nr=array($request->N2hw,$request->N2hw);
        foreach ($tfixed as $key => $value) {
        	$N2nr[$key+2]=$request->Nave*$knr[$key]+$request->N2hw+$request->Nl;
        }



        $operating_load[0]=['Operating Hours [h]','Heat Load [MW]'];
		foreach ($hnr as $key => $value) {
			settype($hnr[$key],"float");
            settype($N2nr[$key],"float");
            $operating_load[$key+1]=[$hnr[$key],$N2nr[$key]];
        }
        return array('load'=>json_encode($operating_load));
      
    }
   

public function calcRiL(Request $request)
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
        $Ril=($Eloss+$Eaux)/$Edel;
        return json_encode($Ril);
       //  return view('calc.testResult',compact('Ril'));
      // return view('calc.result2');
      
    }

    public function calcPEF(Request $request)
    {
       $this->validate($request, array());
        $Q=array($request->QJanuary,$request->QFebruary,$request->QMarch,$request->QApril, $request->QMay, $request->QJune, $request->QJuly, $request->QAugust, $request->QSeptember, $request->QOctober, $request->QNovember, $request->QDecember);
        $Q2=array($request->Q2January,$request->Q2February,$request->Q2March,$request->Q2April, $request->Q2May, $request->Q2June, $request->Q2July, $request->Q2August, $request->Q2September, $request->Q2October, $request->Q2November, $request->Q2December);
        $h= array($request->hJanuary, $request->hFebruary, $request->hMarch, $request->hApril, $request->hMay, $request->hJune, $request->hJuly, $request->hAugust, $request->hSeptember, $request->hOctober, $request->hNovember, $request->hDecember);
      
        return json_encode($pef);
       
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

}
