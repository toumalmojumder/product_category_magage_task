<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'product_id',
    ];
}
