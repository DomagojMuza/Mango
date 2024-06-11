<?php

namespace Mango\Services\Crud;

use App\Helpers\MangoAppFacade;
use Mango\Repositories\ProductRepository;

class ProductService 
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function create(array $data)
    {
        $site_id = MangoAppFacade::getSiteId();
        $data['site_id'] = $site_id;

        return $this->repository->create($data);
    }

    public function find(array $data)
    {
        $site_id = MangoAppFacade::getSiteId();
        $data['site_id'] = $site_id;

        return $this->repository->fetch($data);
    }
}