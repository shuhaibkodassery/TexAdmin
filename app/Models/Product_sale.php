<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_sale extends Model
{
    use HasFactory;
    protected $table = 'product_sales';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'product_price','date', 'discount', 'created_at', 'updated_at'];
}
