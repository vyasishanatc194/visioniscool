<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';
    public function getImage(){
        return $this->hasMany('App\Image', 'city_id', 'id');
    }
    
    public function getState(){
        return $this->belongsTo('App\State', 'state_id');
        // return $this->hasOne('App\State', 'id', 'state_id');
	}
}
