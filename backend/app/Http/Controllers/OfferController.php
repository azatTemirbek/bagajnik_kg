<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResources\OfferResource;
use App\Http\Resources\OfferResources\OfferResourceCollection;
use App\Offer;
use App\User;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * @return OfferResourceCollection
     */
    public function index()
    {
        return new OfferResourceCollection(Offer::paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     * NORMALLY IT SENDS CREATION HTML FORM
     *
     */
    public function create()
    {
        //Do not implement since we dont need it in api
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return OfferResource
     */
    public function store(Request $request)
    {
//      todo:manual validate or Request validate
        $offer = new Offer($request->all());
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
     * Show the form for editing the specified resource.
     * NORMALLY IT SEND EDITING HTML FORM
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Do not implement since we dont need it in api
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Offer $offer
     * @param User $user
     * @return OfferResource
     */
    public function update(Request $request, Offer $offer, User $user)
    {
        //    todo:validate
//       Todo: Update implemantation
        if($offer->update()){
            return new OfferResource($offer);
        }

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
