<?php

namespace Mango\Services\Crud;

use App\Helpers\MangoAppFacade;
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
        $site_id = MangoAppFacade::getSiteId();
        $data['site_id'] = $site_id;

        return $this->productRepository->create($data);
    }

    public function update($data)
    {
        $productsToUpdate = $data['data'] ?? [];
        return $this->productRepository->update($productsToUpdate);
    }

    public function find(array $data)
    {
        $site_id = MangoAppFacade::getSiteId();
        $data['site_id'] = $site_id;

        return $this->productRepository->fetch($data);
    }
}