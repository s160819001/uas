<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function buyer(){
        return $this->belongsTo('App\User','user_id');
    }

    public function medicines(){
        return $this->belongsToMany('App\Medicine')
                    ->withPivot('quantity','price');
    }

    public function insertMedicines($cart,$user){
        $total=0;
        foreach($cart as $id=>$detail){
            $total+=$detail['qty']*$detail['price'];
            $this->medicines()->attach($id,['quantity'=>$detail['qty'],'price'=>$detail['price']]);
        }
        return $total;
    }
}
