<?php

namespace App\Http\Controllers;


use App\Http\Requests\LuggageRequest;
use App\Http\Resources\LuggageResources\LuggageResource;
use App\Http\Resources\LuggageResources\LuggageResourceCollection;
use App\Luggage;
use Validator;
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



    public function index(Request $request)
    {
        $query = Luggage::query();
        $request->has ('name') && $query->where('owner_id', '>=', 45);
        error_log($request->name);
        $luggage = $query->paginate(15);
        return new LuggageResourceCollection($luggage);
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
    public function update(LuggageRequest $request, Luggage $luggage)
    {
        if(
            Validator::make($request->all(), $request->rules(), $request->messages()) &&
            $luggage->update($request->only([
            'takerPhone1',
            'takerPhone2',
            'takerName',
            'comertial',
            'start_dt',
            'end_dt',
            'value',
            'price',
            'mass',
            'from_lat',
            'from_lng',
            'from_formatted_address',
            'from_place_id',
            'to_lat',
            'to_lng',
            'to_formatted_address',
            'to_place_id',
        ]))){
            return new LuggageResource($luggage);
        }
    }

    /**
     * remove the specified resource from storage.
     * @param Luggage $luggage
     * @return LuggageResource
     * @throws \Exception
     */
    public function destroy(Luggage $luggage)
    {
        if ($luggage->delete()) {
            return new LuggageResource($luggage);
        }
    }
}
