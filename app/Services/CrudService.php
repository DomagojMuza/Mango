<?php

namespace Mango\Services;

use App\Helpers\MangoAppFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mango\Services\Crud\ProductService;

class CrudService
{
    public function handle(Request $request)
    {
        $user = Auth::user();

        MangoAppFacade::setSiteFromUser($user);

        $serviceName = $request->getService();
        $type = $request->getEndpoint();
        $method = $request->getFunction();

        $className = $this->getServicePath($type, $serviceName);
        $service = $this->getServiceClass($className);

        $data = $request->all();

        return $service->$method($data);
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