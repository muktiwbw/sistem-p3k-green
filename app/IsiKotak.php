<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IsiKotak extends Model
{
    public function kotak(){
        return $this->belongsTo('App\Kotak');
    }

    public function obat(){
        return $this->belongsTo('App\Obat');
    }

    public function orderItems(){
        return $this->hasMany('App\OrderItem');
    }
}
