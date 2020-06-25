<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = ['city_id'];

    public function getCity(){
        return $this->hasOne('App\City', 'id', 'city_id');
    }
    
    public function getRefFile(){
        return $this->hasOne('App\Refefile', 'refe_field_id', 'id');
    }

    
    public function getAllRefFile(){
        return $this->hasMany('App\Refefile', 'refe_field_id', 'id');
    }

}
