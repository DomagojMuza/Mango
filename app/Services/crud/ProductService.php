<?php

namespace Mango\Services\Crud;

use Mango\Repositories\ProductRepository;

class ProductService 
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function create()
    {
        return 'asdasdasd';
    }
}