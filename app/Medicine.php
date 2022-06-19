<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }

    public function transactions(){
        return $this->belongsToMany('App\Transaction')
                    ->withPivot('quantity','price');
    }
    public $timestamps = false;
}
