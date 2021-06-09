<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //1 = transaction from incoming
    //2 = transaction finished
    //3 = transaction declined

    //belongsToMany( {{Model Neighbor}} {{Intermediate Tabel}} {{Kolom di Intermediate tabel yg model ini isi}} {{Lawan relasinya}})
    
    protected $table = 'transactions' ;

    public function product()
	{
		return $this->belongsToMany('App\Product','transaction_product','transaction_id','product_id')->withPivot('qty', 'note');
	}


}
