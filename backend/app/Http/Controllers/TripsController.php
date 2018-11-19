<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResources\TripsResource;
use App\Http\Resources\TripResources\TripsResourceCollection;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TripsResourceCollection
     */

    public function index(Request $request)
    {
        $query = Trip::query();
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
        /** post end date greater than now */
        // $query->whereDate('end_dt', '>', Carbon::now());
        $trip = $query->orderBy('id', 'desc')->paginate(15);
        return new TripsResourceCollection($trip);
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
     * @return \Illuminate\Http\Response
     */
    public function store(TripRequest $request)
    {
        $trip = new Trip($request->all());
        if($trip->save()){
            return New TripsResource($trip);
        }
    }

    /**
     * Display the specified resource.
     * @param Trip $trip
     * @return TripsResource
     */
    public function show(Trip $trip)
    {
        TripsResource::withoutWrapping();
        return new TripsResource($trip);
    }


    /**
     * Show the form for editing the specified resource.
     * @param $id
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
    public function update(TripRequest $request, $id)
    {
       $tripUpdate = Trip::findOrFail($id);
       if($tripUpdate->fill($request->all())->save()){
           return new TripsResource($tripUpdate);
       };
    }

    /**
     *  Remove the specified resource from storage.
     * @param Trip $trip
     * @return TripsResource
     * @throws \Exception
     */
    public function destroy(Trip $trip)
    {
        if ($trip->delete()) {
            return new TripsResource($trip);
        }
    }
}
