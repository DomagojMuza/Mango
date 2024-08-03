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
        
        $data['slug'] = $this->getSlugForSite($data['slug'], $data['site_id']);
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

        $data['slug'] = $this->getSlugForSite($data['slug'], $data['site_id'], $data['product_id']);

        $slug->update($data);

        return $slug;
    }    

    public function getSlugForSite(string $slug, int $site_id, int|null $product_id = null)
    {
        $slug = Str::slug($slug);
        $slugModel = ProductSlug::where('slug', 'like', $slug . '%' )->where('site_id', $site_id)->first();

        if ($slugModel && $slugModel->product_id != $product_id)
        {
            $segments = explode('-', $slugModel->slug);
            $last_segment = array_pop($segments);

            if (is_numeric($last_segment)) $slug .= '-'. ($last_segment+1);
            else $slug .= '-1';
        }

        return $slug;
    }
}