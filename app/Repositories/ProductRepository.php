<?php


namespace Mango\Repositories;

use App\Models\Product;
use App\Repositories\Settings\ProductSettings;
use Mango\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{

    private $foundIds;
    public function create(array $data)
    {
        return Product::create($data);
    }

    public function delete(int|array $id)
    {
        if ( ! is_array($id)) $id = [$id];
        return Product::whereIn('id', $id);
    }

    public function findById(int|array $id)
    {
        return Product::find($id);
    }

    public function fetch(array $data)
    {
        $this->find($data);
        return $this->load();
    }

    public function find(array $data)
    {
        $productSettings = new ProductSettings($data);
        $ss = $productSettings->getSettings();

        
    }

    public function load()
    {
        if ( ! $this->foundIds) return abort(400);
    }
    
}