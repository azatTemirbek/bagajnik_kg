<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Http\Resources\TripResources\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TripResource::collection(Trip::with('carrier_id')->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trip = Trip::create([
            'carrier_id' => $request->user()->id,
            'start_dt' => $request->start_dt,
            'end_dt' => $request->end_dt,
            'from' => $request->from,
            'to' => $request->to,

        ]);

        return new Trip($trip);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        return new Trip($trip);
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
        // check if currently authenticated user is the owner of the trip
        if ($request->user()->id !== $trip->carrier_id) {
            return response()->json(['error' => 'You can only edit your own trip.'], 403);
        }

        $trip->update($request->only(['start_dt', 'end_dt', 'from','to']));

        return new TripResource($trip);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Trip $trip)
    {
        if ($request->user()->id !== $trip->carrier_id) {
            return response()->json(['error' => 'You can only delete your own trip.'], 403);
        }
        $trip->delete();

        return response()->json(null, 204);
    }
}
