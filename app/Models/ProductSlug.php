<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSlug extends MangoModel
{
    use HasFactory;

    protected $table = 'product_slug_sites';

    protected $fillable = ['slug', 'product_id', 'site_id'];
}
