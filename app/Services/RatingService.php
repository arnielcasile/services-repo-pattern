<?php

namespace App\Services;

use App\Repositories\RatingRepository;

class RatingService
{
    protected $ratingRepository;

    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }

    public function store($data)
    {
        try {
            $result = $this->ratingRepository->store($data);
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}