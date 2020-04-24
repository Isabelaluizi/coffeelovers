<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coffee extends Model
{
    protected $table='coffee';

    public function user() {
        return $this->belongsTo('App\User','user_id','id');
    }
}
