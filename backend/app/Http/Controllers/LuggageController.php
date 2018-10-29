<?php

namespace App\Http\Controllers;


use App\Http\Resources\LuggageResources\LuggageResource;
use App\Http\Resources\LuggageResources\LuggageResourceCollection;
use App\Luggage;
use Illuminate\Http\Request;


class LuggageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return LuggageResourceCollection
     *
     *
     */

    public function index()
    {
        return new LuggageResourceCollection(Luggage::paginate(15));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return LuggageResource
     */
    public function store(Request $request,$id)
    {
//        $errors = array(
//            "errors" => array(),
//            "hasErrors" => false
//        );
//        $agree = $request->get('agree');
//        $status = $request->get('status');
//        if(!($agree == 0 || $agree == 1)){
//            array_push($errors["errors"],"agree: might be 0 or 1");
//            $errors["hasErrors"] = true;
//        }
//        if(!($status == "received" ||
//            $status == "progress" ||
//            $status == "delivered")){
//            array_push($errors["errors"],"status: invalid value");
//            $errors["hasErrors"] = true;
//        }
//        if($errors["hasErrors"]){
//            return $errors;
//        }
//        $store = Offer::where('id', $id)->store($request->all());
//
//        $response = array(
//            "result" => ""
//        );
//        if($store == 1){
//            $response["result"] = "Successfully stored";
//        } else {
//            $response["result"] = "Failed to store. Something went wrong";
//        }
//
//        return $response.toJSON();
        $luggage = new Luggage($request->all());
        if ($luggage->save()) {
            return New LuggageResource($luggage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return LuggageResource
     */
    public function show(Luggage $luggage)
    {
        LuggageResource::withoutWrapping();
        return new LuggageResource($luggage);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return LuggageResource
     */
    public function destroy(Luggage $luggage)
    {
        if ($luggage->delete()) {
            return new LuggageResource($luggage);
        }
    }
}
