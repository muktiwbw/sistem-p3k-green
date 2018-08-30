<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function kotak(){
        return $this->hasOne('App\Kotak');
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }
}
