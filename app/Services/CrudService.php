<?php

namespace Mango\Services;

use Illuminate\Http\Request;
use Mango\Services\Crud\ProductService;

class CrudService
{
    public function handle(Request $request)
    {

        $serviceName = $request->getService();
        $type = $request->getEndpoint();
        $method = $request->getOperation();

        $className = $this->getServicePath($type, $serviceName);
        $service = $this->getServiceClass($className);

        dump($request->all());
        dd($service->$method());
    }


    public function getServiceClass($className)
    {
        if ($this->serviceClassExist($className)) return new $className;
    }

    public function serviceClassExist($className)
    {
        return class_exists($className);
    }

    public function getServicePath($type, $className)
    {
        return '\\Mango\\Services\\' . $type . '\\' . $className;
    }
}