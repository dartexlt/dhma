<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeatModel extends Model
{
    protected $table= 'heat_models';
    
    public function months(){
    	return $this->hasMany('App\Month');
    }
}
