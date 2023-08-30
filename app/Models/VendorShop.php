<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorShop extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_id','shop_name'];
}
