<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kotak extends Model
{
    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function isiKotaks(){
        return $this->hasMany('App\IsiKotak');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }
    
}
