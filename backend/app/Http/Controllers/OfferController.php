<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResources\OfferResource;
use App\Http\Resources\OfferResources\OfferResourceCollection;
use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * @return OfferResourceCollection
     */
    public function index()
    {
        //Get Offers
        $offers = Offer::paginate(15);
        //Return collection of Offers as a resourse
        return new OfferResourceCollection($offers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return OfferResource
     */
    public function store(Request $request)
    {
        $offer = $request->isMethod('put') ? Offer::findOrFail($request->offer_id) : new Offer($request->all());
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
        //if added in App\Providers\AppServiceProvider::boot(), it will apply globally
        OfferResource::withoutWrapping();
        return new OfferResource($offer);
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
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        //
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
