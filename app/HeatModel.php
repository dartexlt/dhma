<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeatModel extends Model
{
    //protected $table= 'heat_models';
        
    public function months(){
    	return $this->hasMany('App\Month');
    }
    public function countries()
    {
    	return $this->belongsTo('App\Country','country_id');
    }
    public function states()
    {
    	return $this->belongsTo('App\State', 'state_id');
    }
    public function cities()
    {
    	return $this->belongsTo('App\City','city_id');
    }
}
