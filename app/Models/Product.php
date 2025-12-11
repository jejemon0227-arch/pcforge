<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Ito ang listahan ng fields na PWEDE mong i-update (Fillable).
    protected $fillable = [
        'product_title',
        'product_description',
        'product_quantity', // Naka-fillable na, kaya pwede i-update!
        'product_price',
        'product_image',
        'product_category',
    ];
}