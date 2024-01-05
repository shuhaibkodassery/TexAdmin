<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_name', 'user_type', 'is_active', 'user_pwd', 'remember_token', 'created_at', 'updated_at'];
}
