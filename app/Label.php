<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    public function goal()
     {
         return $this->hasMany('App\Goal');
     }
}
