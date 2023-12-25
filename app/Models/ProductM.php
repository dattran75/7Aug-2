<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductM extends Model
    {
        
        use HasFactory;
        protected $table="products";
        protected $fillable=['id','name','quantity','price','discount','status','idBrand','idCate','images','content', 'created_at','updated_at','deleted_at'];

    }
