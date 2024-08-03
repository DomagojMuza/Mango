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

    public function delete(int $id)
    {
        try 
        {
            $product = Product::find($id);
            if ( ! $product) throw new \Exception('Product not found');
            return $product->delete();
        } 
        catch (\Exception $e) 
        {
            return abort(500, $e->getMessage());
        }
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

    public function update(array $data, int $id)
    {
    
        try 
        {
            $product = Product::where('id', $id)->where('site_id', $data['site_id'])->first();

            if (! $product) throw new \Exception('Product not found');

            $validator = Validator::make($data, 
                [
                    'name' => 'nullable|string'
                ]
            );

            if ($validator->fails()) throw new \Exception('Data types mismatch');
            
            $newData = $validator->validated();
            
            $product->update($newData);

        } 
        catch (\Exception $e) 
        {
            \DB::rollback();
            return abort(500, $e->getMessage());
        }

        return $product;
    }
    
}