<?php

namespace Mango\Services\Crud;

use App\Helpers\MangoAppFacade;
use App\Models\Product;
use Mango\Repositories\ImageRepository;
use Mango\Repositories\ProductSlugRepository;

class ImageService 
{
    protected $imageRepository;

    public function __construct()
    {
        $this->imageRepository = new ImageRepository();
    }

    public function create(array $data)
    {
        return $this->imageRepository->create($data);
    }

    public function delete($data, $id)
    {
        return $this->imageRepository->delete($id);
    }
}