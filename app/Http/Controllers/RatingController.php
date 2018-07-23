<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRating;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function store(StoreRating $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();
            Rating::create($data);
        });
        $data = $request->data();
        $rating=($data['rad1']+$data['rad2']+$data['rad3'])/3;
        return view('ratingg2',compact('rating'));

    }


}

