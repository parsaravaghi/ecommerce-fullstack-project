<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        "name" ,
        "description" ,
        "price" ,
        "products_count" ,
        "image_url" ,
        "is_verified" ,
        "owner"
    ];

    protected $hidden = [
        "sales_count" ,
        "added_at"
    ];
}
