<?php


namespace Mango\Repositories;

use App\Models\Product;
use App\Repositories\Settings\ProductSettings;
use Mango\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;

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
        return Product::with('slug')->find($id);
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

        if ($ss->productIds ?? null) return $this->findById($ss->productIds);
    }

    public function load()
    {
        if ( ! $this->foundIds) return abort(400);
    }

    public function update(array $products)
    {
        if (! $products) abort(400, 'No products to update');

        $productIds = array_column($products,'id');

        $foundProducts = $this->find(['productIds' => $productIds]);

        \DB::beginTransaction();

        try {
            foreach ($foundProducts as $product) 
            {
                $newData = current(array_filter($products, function($_product) use($product) { return $product->id == $_product['id']; }));
                $updateSlug = $newData['updateSlug'] ?? false;

                $validator = Validator::make($newData, 
                    [
                        'name' => 'nullable|string'
                    ]
                );

                if ($validator->fails()) throw new \Exception('Data types mismatch');
                
                $newData = $validator->validated();
               
                $product->fill($newData);
                $product->save();
            }

            \DB::commit();
        } catch (\Exception $e) 
        {
            \DB::rollback();
            return abort(500, $e->getMessage());
        }

    }
    
}