<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function save(array $options = array())
    {
        if (! $this?->slug || $this->isDirty('slug')) 
        {
            $this->slug = slugify($this->slug ?? $this->name);

            $similar = Product::where('slug', 'like', $this->slug . '%' )
                ->orderBy('id', 'DESC')->get()->first();

            if ($similar) 
            {
                $segments = explode('-', $similar->slug);
                $last_segment = array_pop($segments);

                if (is_numeric($last_segment)) $this->slug .= '-'. ($last_segment+1);
                else $this->slug .= '-1';
            }
        }

        parent::save($options);
    }


}