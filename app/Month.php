<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    public function heat_models()
    {
    	return $this->belongsTo('App\HeatModel');
    }
}
