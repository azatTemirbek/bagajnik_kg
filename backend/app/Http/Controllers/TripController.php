<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * "first_page_url": "http://127.0.0.1:8000/api/trips?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "http://127.0.0.1:8000/api/trips?page=5",
    "next_page_url": "http://127.0.0.1:8000/api/trips?page=2",
    "path": "http://127.0.0.1:8000/api/trips",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 50
     */

    public function index()
    {
        $trips = Trip::paginate(10);
        return response()->json(["trips" => $trips]);
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
    public function store(Request $request)
    {
        $this -> validate($request, [
            'carrier_id' => 'required',
            'offer_id' => 'required'
        ]);

        $trip = new Trip();
        $offer_id  = Trip::find($request->input('offer_id'));
        //On left field name in DB and on right field name in Form/view
        $trip->carrier = $request->input('carrier_id');
        $trip->offers = $request->input('offer_id');
        $trip->save();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
       return $trip->toArray();
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
