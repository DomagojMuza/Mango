<?php

namespace Mango\Services\Crud;

use App\Helpers\MangoAppFacade;
use Mango\Repositories\SummaryRepository;

class ImageService 
{
    protected $summaryRepository;

    public function __construct()
    {
        $this->summaryRepository = new SummaryRepository();
    }

    public function create(array $data)
    {

        
        return $this->summaryRepository->create($data);
    }


}