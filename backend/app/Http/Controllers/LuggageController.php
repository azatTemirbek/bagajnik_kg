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
    public function store(LuggageRequest $request,$id)
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
    public function update(LuggageRequest $request, $id)
    {
        $luggageUpdate = Luggage::findOrFail($id);
        $inputs = $request->all();
        $luggageUpdate->fill($inputs)->save();

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
