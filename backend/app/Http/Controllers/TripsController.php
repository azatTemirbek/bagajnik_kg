<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        return new TripsResourceCollection(Trip::paginate(15));

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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        TripsResource::withoutWrapping();
        return new TripsResource($trip);
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
        $errors = array(
            "errors" => array(),
            "hasErrors" => false
        );
        $agree = $request->get('agree');
        $status = $request->get('status');
        if(!($agree == 0 || $agree == 1)){
            array_push($errors["errors"],"agree: might be 0 or 1");
            $errors["hasErrors"] = true;
        }
        if(!($status == "received" ||
            $status == "progress" ||
            $status == "delivered")){
            array_push($errors["errors"],"status: invalid value");
            $errors["hasErrors"] = true;
        }
        if($errors["hasErrors"]){
            return $errors;
        }
        $updated = Offer::where('id', $id)->update($request->all());

        $response = array(
            "result" => ""
        );
        if($updated == 1){
            $response["result"] = "Successfully updated";
        } else {
            $response["result"] = "Failed to update. Something went wrong";
        }

        return $response.toJSON();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        if ($trip->delete()) {
            return new TripsResource($trip);
        }
    }
}
