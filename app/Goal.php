<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
        //Userモデルと【一対多】の逆向きのリレーションを定義する(多のほう)
    }
    
    public function todos()
    {
        return $this->hasMany('App\ToDo');
    }
}
