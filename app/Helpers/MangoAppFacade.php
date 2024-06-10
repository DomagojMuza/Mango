<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Facade;

class MangoAppFacade extends Facade
{
     protected static function getFacadeAccessor()
     {
          return 'MangoApp';
     }
}