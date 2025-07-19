<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        "title" ,
        "description" ,
        "price" ,
        "products_count" ,
        "imageUrl"
    ];

    protected $hidden = [
        "sales_count" ,
        "added_at"
    ];
}
