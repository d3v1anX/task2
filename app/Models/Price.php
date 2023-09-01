<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','shop_id','sale_price'];


    public function products(){
        return $this->belongsTo('products','id','product_id');
    }

    public function shops(){
        return $this->belongsTo('vendor_shops','id','shop_id');
    }
}
