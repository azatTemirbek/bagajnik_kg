<?php

namespace App\Http\Controllers;


use App\Http\Requests\LuggageRequest;
use App\Http\Resources\LuggageResources\LuggageResource;
use App\Http\Resources\LuggageResources\LuggageResourceCollection;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use App\Luggage;
use Validator;
use Illuminate\Http\Request;


class LuggageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return LuggageResourceCollection
     */
    public function index(Request $request)
    {
        $query = Luggage::query();
        if ($request->has('to_formatted_address') && $request->to_formatted_address <> 'null') {
            $query->where('to_formatted_address', 'like', "%$request->to_formatted_address%");
        }
        if ($request->has('from_formatted_address') && $request->from_formatted_address <> 'null') {
            $query->where('from_formatted_address', 'like', "%$request->from_formatted_address%");
        }
        if ($request->has('start_dt') && $request->start_dt <> 'null') {
            $query->whereDate('start_dt', '>', Carbon::parse($request->start_dt));
        }
        if ($request->has('end_dt') && $request->end_dt <> 'null') {
            $query->whereDate('start_dt', '<', Carbon::parse($request->end_dt));
        }
        if ($request->has('comertial') && $request->comertial <> 'null') {
            $query->where('comertial', '=', $request->comertial);
        }
        if ($request->has('mass') && $request->mass <> 'null') {
            $query->whereBetween('mass', explode(',', $request->mass));
        }
        if ($request->has('value') && $request->value <> 'null') {
            $query->where('value', 'like', "%$request->value%");
        }
        if ($request->has('price') && $request->price <> 'null') {
            $query->whereBetween('price', explode(',', $request->price));
        }
        if ($request->has('owner_id') && $request->owner_id <> 'null') {
            $query->where('owner_id', $request->owner_id);
        }
        // offer aggre false olanlari filtrele
        // $query->offers()->where('agree','=',false);
        // $query->whereDate('end_dt', '>', Carbon::now());
        $luggage = $query->orderBy('id', 'desc')->paginate(15);
        return new LuggageResourceCollection($luggage);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param LuggageRequest $request
     * @return LuggageResource
     */
    public function store(LuggageRequest $request)
    {
        $luggage = new Luggage($request->all());
        $luggage->owner_id = $request->user('api')->id;
        if ($luggage->save()) {
            return New LuggageResource($luggage);
        }
    }

    /**
     * Display the specified resource.
     * @param Luggage $luggage
     * @return LuggageResource
     */
    public function show(Luggage $luggage)
    {
        LuggageResource::withoutWrapping();
        return new LuggageResource($luggage);
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     * @param LuggageRequest $request
     * @param $id
     * @return LuggageResource
     */
    public function update(LuggageRequest $request, $id)
    {
        $luggageUpdate = Luggage::findOrFail($id);
        $inputs = $request->all();
        if ($request->user('api')->id == $luggageUpdate->owner_id && $luggageUpdate->fill($inputs)->save()) {
            return new LuggageResource($luggageUpdate);
        } else {
            response()->json(['error' => 'no update'], Response::HTTP_UNPROCESSABLE_ENTITY);
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
