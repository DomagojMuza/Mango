<?php

namespace Mango\Services\Crud;

use App\Helpers\MangoAppFacade;
use Mango\Repositories\SummaryRepository;

class SummaryService 
{
    protected $summaryRepository;

    public function __construct()
    {
        $this->summaryRepository = new SummaryRepository();
    }

    public function update(array $data)
    {
        return $this->create($data);
    }

    public function create(array $data)
    {

        $summaries = [];
        $parent_type = $data['parent_type'];
        $parent_id = $data['parent_id'];
        $site_id = $data['site_id'];

        foreach ($data['summaries'] as $summary) 
        {
            $summary_type = $summary['type'];
            unset($summary['type']);
            
            foreach ($summary as $key => $text) {
                [$first, $language] = explode('_', $key);

                $summaries[] = (object)[
                    'language'      => $language,
                    'type'          => $summary_type,
                    'text'          => $text,
                    'parent_type'   => $parent_type,
                    'parent_id'     => $parent_id,
                    'site_id'       => $site_id,
                ];

            }
        }

        $createData = [
            'parent_id'     => $parent_id,
            'site_id'       => $site_id,
            'parent_type'   => $parent_type,
            'summaries'     => collect($summaries)
        ];

        return $this->summaryRepository->create($createData);
    }


}