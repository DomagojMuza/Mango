<?php

namespace App\Helpers;

use App\Models\Site;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;

class MangoApp 
{
    private $site;

    public function __construct()
    {
        
    }

    public function getSite()
    {
        return $this->site;
    }
    
    public function getSiteId()
    {
        return $this->site->id;
    }

    public function setSiteFromUser(User|Authenticatable $user)
    {
        $siteId = $user->site_id;
        $site = Site::find($siteId);

        if ( ! $site ) throw new Exception("Site not found", 500);
        $this->site = $site;    
    }

    public function setSiteBySiteId(int $siteId)
    {
        $site = Site::find($siteId);

        if ( ! $site ) throw new Exception("Site not found", 500);
        $this->site = $site;       
    }
}