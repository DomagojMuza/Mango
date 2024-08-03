<?php

namespace Mango\Services\Crud;

use App\Helpers\MangoAppFacade;
use Mango\Repositories\ProductSlugRepository;

class ProductSlugService 
{
    protected $productSlugRepository;

    public function __construct()
    {
        $this->productSlugRepository = new ProductSlugRepository();
    }

    public function create(array $data)
    {
        return $this->productSlugRepository->create($data);
    }

    public function update($data)
    {
        return $this->productSlugRepository->update($data);
    }

    public function find(array $data)
    {
        $site_id = MangoAppFacade::getSiteId();
        $data['site_id'] = $site_id;

        // return $this->productSlugRepository->fetch($data);
    }
}