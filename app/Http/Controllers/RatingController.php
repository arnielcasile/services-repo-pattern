<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RatingService;

class RatingController extends Controller
{

    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->middleware('auth:api');
        $this->ratingService = $ratingService;
    }
   
    public function store(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'rating'  => $request->rating,
        ];

        return $this->ratingService->store($data);
    }
}
