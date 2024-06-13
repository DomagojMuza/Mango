<?php


namespace Mango\Repositories;

use App\Models\ProductSlug;
use Illuminate\Support\Str;
use Mango\Repositories\BaseRepository;

class ProductSlugRepository extends BaseRepository
{

    public function create(array $data) :ProductSlug
    {
        $slug = ProductSlug::where('product_id', $data['product_id'])->where('site_id', $data['site_id'])->first();
        if ($slug) return $this->update($data, $slug);
        
        $data['slug'] = Str::slug($data['slug']);

        $slug = ProductSlug::where('slug', 'like', $data['slug'] . '%' )->where('site_id', $data['site_id'])->first();
        if ($slug)
        {
            $segments = explode('-', $slug->slug);
            $last_segment = array_pop($segments);

            if (is_numeric($last_segment)) $data['slug'] .= '-'. ($last_segment+1);
            else $data['slug'] .= '-1';
        }

        return ProductSlug::create($data);
    }

    public function delete(int|array $id)
    {
        if ( ! is_array($id)) $id = [$id];
        return ProductSlug::whereIn('id', $id);
    }


    public function update($data, ProductSlug $slug = null) :ProductSlug
    {
        if ( ! $slug) $slug = ProductSlug::where('product_id', $data['product_id'])->where('site_id', $data['site_id'])->first();
        $data['slug'] = Str::slug($data['slug']);

        $slug->update($data);

        return $slug;
    }
    
}