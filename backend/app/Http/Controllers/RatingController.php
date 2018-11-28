<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Http\Resources\RatingResources\RatingsResource;
use App\Http\Resources\RatingResources\RatingsResourceCollection;
use App\Rating;
use Illuminate\Http\Request;


class RatingController extends Controller
{
    public function index(Request $request)
    {
        $query = Rating::query();
        $request->has('name') && $query->where('to_user_id', '>=', 45);
        $rating = $query->paginate(15);
        return new RatingsResourceCollection($rating);
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage
     * @param RatingRequest $request
     * @return RatingsResource
     */
    public function store(RatingRequest $request)
    {
        $rating = new Rating($request->all());
        if ($rating->save()) {
            return New RatingsResource($rating);
        }
    }

    /**
     * Display the specified resource.
     * @param Rating $rating
     * @return RatingsResource
     */
    public function show(Rating $rating)
    {
        RatingsResource::withoutWrapping();
        return new RatingsResource($rating);
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage
     * @param RatingRequest $request
     * @param $id
     */
    public function update(RatingRequest $request, $id)
    {
        $ratingUpdate = Rating::findOrFail($id);
        $inputs = $request->all();
        $ratingUpdate->fill($inputs)->save();
    }

    /**
     * Remove the specified resource from storage.
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
