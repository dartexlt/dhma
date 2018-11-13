<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Month;
use App\HeatModel;
use Session;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
}
