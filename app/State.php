<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
     //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    protected $fillable = ['state_name'];

    public function getCity(){
        return $this->hasMany('App\City', 'state_id', 'id');
	}
}
