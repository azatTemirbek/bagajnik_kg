<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Http\Resources\OfferResources\OfferResource;
use App\Http\Resources\OfferResources\OfferResourceCollection;
use App\Luggage;
use App\Mail\AcceptMail;
use App\Offer;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function MongoDB\BSON\toJSON;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    /**
     * @param Request $request
     * @return OfferResourceCollection
     */
    public function index(Request $request)
    {
        $query = Offer::query();
        if ($request->has('req_user_id') && $request->req_user_id <> 'null') {
            $query->where('req_user_id', '=', $request->req_user_id);
        }
        if ($request->has('res_user_id') && $request->res_user_id <> 'null') {
            $query->where('res_user_id', '=', $request->res_user_id);
        }
        if ($request->has('status1') && $request->status1 <> 'null' && $request->has('status2') && $request->status2 <> 'null') {
            $query->orWhere('status', '=', $request->status1);
            $query->orWhere('status', '=', $request->status2);
        }
        if ($request->has('status') && $request->status <> 'null') {
            $query->where('status', '=', $request->status);
        }
        // dd($query->toSql());
        // error_log($request->req_user);
        $offer = $query->orderBy('id', 'desc')->paginate(15);
        return new OfferResourceCollection($offer);
    }

    /**
     * Store a newly created resource in storage.
     * @param OfferRequest $request
     * @return OfferResource
     */
    public function store(OfferRequest $request)
    {
        $offer = new Offer($request->all());
        $offer->req_user_id = $request->user('api')->id;
        // get the trip and is uersid
        $trip = Trip::findOrFail($request->trip_id);
        //        get the luggage and is uersid
        $luggage = Luggage::findOrFail($request->luggage_id);
        $offer->res_user_id = ($trip->carrier_id = $request->user('api')->id) ? $luggage->owner_id : $trip->carrier_id;
        if ($offer->save()) {
            return New OfferResource($offer);
        }
    }

    /**
     * Display the specified resource.
     * @param Offer $offer
     * @return OfferResource
     */
    public function show(Offer $offer)
    {
        OfferResource::withoutWrapping();
        return new OfferResource($offer);
    }

    /**
     * Update the specified resource in storage.
     * @param OfferRequest $request
     * @param $id
     * @return OfferResource
     */
    public function update(OfferRequest $request, $id)
    {
        $offerUpdate = Offer::findOrFail($id);
        $inputs = $request->all();
        $offerUpdate->fill($inputs)->save();
        return new OfferResource($offerUpdate);
    }

    /**
     * Update the specified resource in storage
     * @param OfferRequest $request
     * @param $id
     * @return OfferResource
     */
    public function accept(OfferRequest $request, $id)
    {
        $offerUpdate = Offer::findOrFail($id);
        $inputs = $request->all(['agree', 'status']);
        $offerUpdate->fill($inputs)->save();
        $query = Offer::query();
        $query->where('id', '<>', $id);
        $query->where('luggage_id', '=', $offerUpdate->luggage_id);
        $query->orWhere('trip_id', '=', $offerUpdate->trip_id);
        $query->update(['status' => 'responded', 'agree' => false]);
        $this->sendMail($offerUpdate);
        return new OfferResource($offerUpdate);
    }

    private function sendMail(Offer $offer)
    {
        Mail::to($offer->req_user->email)->send(new AcceptMail($offer));
        Mail::to($offer->res_user->email)->send(new AcceptMail($offer));
        return true;
    }

    /**
     * Remove the specified resource from storage.
     * @param Offer $offer
     * @return OfferResource
     * @throws \Exception
     */
    public function destroy(Offer $offer)
    {
        if ($offer->delete()) {
            return new OfferResource($offer);
        }
    }
}
