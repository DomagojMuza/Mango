<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\MangoAppFacade;

class Product extends MangoModel
{

    use SoftDeletes;
    
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function slug()
    {
        return $this->hasOne(ProductSlug::class, 'product_id', 'id')->where('site_id', MangoAppFacade::getSiteId());
    }

    public function summary()
    {
        return $this->hasMany(Summary::class, 'parent_id', 'id')->where('parent_type', 'product')->where('site_id', MangoAppFacade::getSiteId());
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'parent_id', 'id')->where('parent_type', 'product');
    }



}
