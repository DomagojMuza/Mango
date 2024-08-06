<?php


namespace Mango\Repositories;

use App\Models\Summary;
use Mango\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;

class SummaryRepository extends BaseRepository
{

    private $foundIds;
    public function create(array $data)
    {
        try 
        {
            return $this->insert($data);   
        } catch (\Exception $e) 
        {
            return abort(500, $e->getMessage());
        }
    }
    public function update(array $data)
    {
        try 
        {
            return $this->insert($data);
        } catch (\Exception $e) 
        {
            return abort(500, $e->getMessage());
        }
    }
    public function insert(array $data)
    {
        try 
        {
            # Potrebno ubaciti Validator
            $summariesInDB = Summary::where('site_id', $data['site_id'])->where('parent_type', $data['parent_type'])->where('parent_id', $data['parent_id'])->get();

            $data['summaries']->each(function($summary, $key) use($summariesInDB)
            {
                $entryToUpdate = $summariesInDB->first(function($item) use($summary) {
                    return $item->type == $summary->type && $item->language == $summary->language;
                });
                if ($entryToUpdate)
                {
                    if (! $summary->text) $entryToUpdate->delete();
                    else $entryToUpdate->update((array)$summary);
                }
                else
                {
                    Summary::create((array)$summary);
                }
            });

            return true;

        } catch (\Exception $e) 
        {
           return abort(500, $e->getMessage());
        }
    }
    
}