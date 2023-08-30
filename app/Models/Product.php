<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'product_description', 'sku', 'vendor_id', 'product_group_id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id',);
    }


    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id', 'id',);
    }
}
