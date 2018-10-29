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
    public function store(Request $request)
    {
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
    public function update(Request $request, Luggage $luggage)
    {

        if($luggage->update($request->only([
            'takerPhone1',
            'takerPhone2',
            'takerName',
            'comertial',
            'start_dt',
            'end_dt',
            'value',
            'price',
            'from',
            'mass',
            'to',
        ]))){
            return new LuggageResource($luggage);
        }
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
