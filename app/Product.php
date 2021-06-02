<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    //belongsTo {{Model Sebelah}} {{foreignkey}} {{primarykey Model sebelah}}
    
    public function getPhoto(){
        if(!$this->photo){
            return asset('assets/logo wan-group.png');
        }

        return asset('product-photo/'.$this->photo);
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
}
