<?php

namespace Mango\Services\Crud;

use App\Helpers\MangoAppFacade;
use App\Models\Product;
use Mango\Repositories\ProductRepository;
use Mango\Repositories\ProductSlugRepository;

class ProductService 
{
    protected $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->productRepository->update($data, $id);
    }

    public function find(array $data)
    {
        return $this->productRepository->fetch($data);
    }
}