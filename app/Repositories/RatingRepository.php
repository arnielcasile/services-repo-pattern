<?php

namespace App\Repositories;

use App\Models\Rating;
use App\Http\Resources\RatingResource;

class RatingRepository
{
    protected $ratingModel;

    public function __construct(Rating $ratingModel)
    {
        $this->ratingModel = $ratingModel;
    }

    public function store($data)
    {
        return $this->ratingModel->create($data);
    }
}