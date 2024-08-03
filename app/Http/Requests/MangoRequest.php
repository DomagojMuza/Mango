<?php

namespace App\Http\Requests;

use Illuminate\Http\Request as LaravelRequest;

class MangoRequest extends LaravelRequest
{

    public function getEndpoint()
    {
        $service = $this->segment(1);
        return $service ? ucfirst($service) : null;
    }

    public function getService()
    {
        $service = $this->segment(2);
        return $service ? ucfirst($service) . 'Service' : null;
    }

    public function getFunction()
    {
        return $this->segment(3);
    }
    public function getId()
    {
        return $this->segment(4);
    }

}