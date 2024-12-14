<?php

namespace App\Models;

use App\Collections\SummaryCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Summary extends MangoModel
{
    use HasFactory;
    protected $guarded = ['id'];

    public function newCollection(array $models = []): Collection
    {
        return new SummaryCollection($models);
    }
}
