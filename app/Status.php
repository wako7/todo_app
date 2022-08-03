<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function goal()
     {
         return $this->hasMany('App\Goal');
     }
    
    public function todos()
     {
         return $this->hasMany('App\Todo');
     }
}
