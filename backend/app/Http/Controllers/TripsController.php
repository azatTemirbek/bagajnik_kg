<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResources\TripsResource;
use App\Http\Resources\TripResources\TripsResourceCollection;
use App\Trip;
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
        $request->has ('name') && $query->where('carrier_id', '>=', 45);
        error_log($request->name);
        $trip = $query->paginate(15);
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
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());
//        $this -> validate($request, [
//            'carrier_id' => 'required',
//            'offer_id' => 'required'
//        ]);

//        $offer_id  = Trip::find($request->input('offer_id'));
//        //On left field name in DB and on right field name in Form/view
//        $trip->carrier = $request->input('carrier_id');
//        $trip->offers = $request->input('offer_id');
        $trip = new Trip($request->all());
        if($trip->save()){
            return New TripsResource($trip);
        }
        //
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
    public function update(Request $request, Trip $trip)
    {
//        $updated = Trip::findOrFail($trip->id)->update($request->all());
//        return New TripsResource($updated);
        if($trip->update($request->only([
            'start_dt',
            'end_dt',
            'from_lat',
            'from_lng',
            'from_formatted_address',
            'from_place_id',
            'to_lat',
            'to_lng',
            'to_formatted_address',
            'to_place_id',
        ]))){
            return new TripsResource($trip);
        }
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
