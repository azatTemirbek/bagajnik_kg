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
     * @return RatingsResourceCollection
     *
     * "first_page_url": "http://127.0.0.1:8000/api/ratings?page=1",
    * "from": 1,
    * "last_page": 5,
    * "last_page_url": "http://127.0.0.1:8000/api/ratings?page=5",
    * "next_page_url": "http://127.0.0.1:8000/api/ratings?page=2",
    * "path": "http://127.0.0.1:8000/api/ratings",
    * "per_page": 10,
    * "prev_page_url": null,
    * "to": 10,
    * "total": 50
     */
    public function index(Request $request)
    {
        $query = Rating::query();
        $request->has ('name') && $query->where('to_user_id', '>=', 45);
        error_log($request->name);
        $rating = $query->paginate(15);
        return new RatingsResourceCollection($rating);
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
    public function update(Request $request, $id)
    {
        $errors = array(
            "errors" => array(),
            "hasErrors" => false
        );
        $rate = $request->get('rate_value');
        $comment = $request->get('comment');
        if(!($rate >= 5)){
            array_push($errors["errors"],"rate: might be max 5");
            $errors["hasErrors"] = true;
        }
        if(!(strlen($comment) <= 200 )){
            array_push($errors["errors"],"comment: max length 200");
            $errors["hasErrors"] = true;
        }
        if($errors["hasErrors"]){
            return $errors;
        }
        $updated = Rating::where('id', $id)->update($request->all());

        $response = array(
            "result" => ""
        );
        if($updated == 1){
            $response["result"] = "Successfully updated";
        } else {
            $response["result"] = "Failed to update. Something went wrong";
        }

        return $response.toJSON();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        if ($rating->delete()) {
            return new RatingsResource($rating);
        }
    }
}
