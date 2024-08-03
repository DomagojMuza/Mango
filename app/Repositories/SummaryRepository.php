<?php


namespace Mango\Repositories;

use App\Models\Image;
use Mango\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;

class SummaryRepository extends BaseRepository
{

    private $foundIds;
    public function create(array $data)
    {
        try 
        {

        } catch (\Exception $e) 
        {
            return abort(500, $e->getMessage());
        }
    }
    public function update(array $data)
    {
        try 
        {

        } catch (\Exception $e) 
        {
            return abort(500, $e->getMessage());
        }
    }
    public function insert(array $data)
    {
        try 
        {

        } catch (\Exception $e) 
        {
            return abort(500, $e->getMessage());
        }
    }
    
}