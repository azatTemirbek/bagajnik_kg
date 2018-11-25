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
        if($request->has ('to_formatted_address') && $request->to_formatted_address <> 'null'){
            $query->where('to_formatted_address', 'like', "%$request->to_formatted_address%");
        }
        if($request->has ('from_formatted_address') && $request->from_formatted_address <> 'null'){
            $query->where('from_formatted_address', 'like', "%$request->from_formatted_address%");
        }
        if($request->has ('start_dt') && $request->start_dt <> 'null'){
            $query->whereDate('start_dt', '>', Carbon::parse($request->start_dt));
        }
        if($request->has ('end_dt') && $request->end_dt <> 'null'){
            $query->whereDate('start_dt', '<', Carbon::parse($request->end_dt));
        }
        if($request->has ('comertial') && $request->comertial <> 'null'){
            $query->where('comertial', '=',$request->comertial);
        }
        if($request->has ('mass') && $request->mass <> 'null'){
            $query->whereBetween('mass',explode(',', $request->mass));
        }
        if($request->has ('value') && $request->value <> 'null'){
            $query->where('value', 'like', "%$request->value%");
        }
        if($request->has ('price') && $request->price <> 'null'){
            $query->whereBetween('price',explode(',', $request->price));
        }
        // offer aggre false olanlari filtrele
        // $query->offers()->where('agree','=',false);
        // $query->whereDate('end_dt', '>', Carbon::now());
        $luggage = $query->orderBy('id', 'desc')->paginate(15);
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
        error_log('udate');
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
