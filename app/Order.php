<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderItems(){
        return $this->hasMany('App\OrderItem');
    }

    public function kotak(){
        return $this->belongsTo('App\Kotak');
    }
}
