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

        $validator = Validator::make($data, 
            [
                'site_id' => 'nullable:integer'
            ]
        );

        if ($validator->fails()) abort(400);

        $this->settings = $validator->validated();
    }

    public function getSettings()
    {
        return $this->settings;
    }
}