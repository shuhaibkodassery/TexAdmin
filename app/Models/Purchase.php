<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $primaryKey = 'purchase_id';
    protected $fillable = ['purchase', 'amount', 'purchase_date', 'is_active', 'created_at', 'updated_at'];
}
