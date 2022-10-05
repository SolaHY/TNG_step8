<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = ['id', 'product_id'];
     
     public function order(){
      return $this->belongsTo('App\Models\User', 'sale');
    }
    
     public function item(){
      return $this->belongsTo('App\Models\Product');
    }

  
}
