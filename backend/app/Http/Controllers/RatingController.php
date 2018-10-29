<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResources\RatingsResource;
use App\Http\Resources\RatingResources\RatingsResourceCollection;
use App\Rating;
use Illuminate\Http\Request;


class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * "first_page_url": "http://127.0.0.1:8000/api/ratings?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "http://127.0.0.1:8000/api/ratings?page=5",
    "next_page_url": "http://127.0.0.1:8000/api/ratings?page=2",
    "path": "http://127.0.0.1:8000/api/ratings",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 50
     */
    public function index()
    {
        return new RatingsResourceCollection(Rating::paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RatingsResourceCollection
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rating = new Rating($request->all());
        if ($rating->save()) {
            return New RatingsResource($rating);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return RatingsResource
     */
    public function show(Rating $rating)
    {
        RatingsResource::withoutWrapping();
        return new RatingsResource($rating);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        if($rating->update($request->only([
            'rate_value',
            'comment',
        ]))){
            return new RatingResource($rating);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rating $rating
     * @return RatingsResource
     * @throws \Exception
     */
    public function destroy(Rating $rating)
    {
        if ($rating->delete()) {
            return new RatingsResource($rating);
        }
    }
}
