<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends MangoModel
{

    use SoftDeletes;
    
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}
