<?php

namespace App\Repositories\Settings;

use App\Helpers\MangoAppFacade;
use Illuminate\Support\Facades\Validator;

class ProductSettings 
{
    private $settings;

    public function __construct(array $data)
    {
        if ( ! ($data['site_id'] ?? null) ) $data['site_id'] = MangoAppFacade::getSiteId();

        if ( ($data['productIds'] ?? null) && is_string($data['productIds'])) $data['productIds'] = array_unique(explode(',', $data['productIds']));

        $validator = Validator::make($data, 
            [
                'site_id' => 'nullable|integer',
                'productIds' => 'nullable|array',
                'productIds.*' => 'nullable|integer'
            ]
        );

        if ($validator->fails()) abort(400);

        $this->settings = (object)$validator->validated();
    }

    public function getSettings()
    {
        return $this->settings;
    }
}