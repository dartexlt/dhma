<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $N = array();
        foreach ($Q as $key => $value) {
        	$N[$key]=$Q[$key]/$h[$key];
        }
        $heatingSeason=array(1,1,1,1,0,0,0,0,0,1,1,1);
        $temp=0;
        $sumxy=0;
        $sumx=0;
        $sumy=0;
        $sumxx=0;
        $sumn=0;
        $Nhv=0;
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
        $tfixed=array(8,5,0,-5,-10,-15,-20,-25);
		$Nfixed=array($Nhv,$Nhv);
		foreach ($tfixed as $key => $value) {
        	$Nfixed[$key+2]=$a*$tfixed[$key]+$b;
        }

		/*$arr = array_add($request, 'Nhv'=>$Nhv);*/
        /*return redirect()->route('calc.result',compact('Q','h','t','N','Nhv'));*/
        return view('calc.result',compact('Q','h','t','N','Nhv','a','b','Nfixed'));

       
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
