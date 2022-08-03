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
    
    public function label()
    {
        return $this->belongsTo('App\Label');
        //Labelモデルと【一対多】の逆向きのリレーションを定義する(多のほう)
    }
    
    public function status()
    {
        return $this->belongsTo('App\Status');
        //Statusモデルと【一対多】の逆向きのリレーションを定義する(多のほう)
    }
    
   public function todos()
     {
         return $this->hasMany('App\Todo');
     }
     
     public function detail()
     {
         return $this->hasMany('App\Detail');
     }
}
