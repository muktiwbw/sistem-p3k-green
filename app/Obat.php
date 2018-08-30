<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    public function isiKotaks(){
        return $this->hasMany('App\IsiKotak');
    }
}
