<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    //belongsTo {{Model Sebelah}} {{foreignkey_kita}} {{primarykey Model sebelah}}
    
    public function getPhoto(){
        if(!$this->photo){
            return asset('assets/logo wan-group.png');
        }

        return asset('product-photo/'.$this->photo);
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function transaction()
	{
		return $this->belongsToMany('App\Transaction','transaction_product','product_id','transaction_id')->withPivot('qty', 'note');
	}
}
