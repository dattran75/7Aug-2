<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleM extends Model
{
    protected $table='userroles';
    protected $fillable=['id','name','status','created_at','updated_at'];
    use HasFactory;
}

    