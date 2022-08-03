<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public function goal()
    {
        return $this->belongsTo('App\Goal');
        //Goalモデルと【一対多】の逆向きのリレーションを定義する(多のほう)
    }
}
