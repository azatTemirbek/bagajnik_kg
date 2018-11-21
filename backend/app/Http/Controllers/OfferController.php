<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Http\Resources\OfferResources\OfferResource;
use App\Http\Resources\OfferResources\OfferResourceCollection;
use App\Offer;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class OfferController extends Controller
{
    /**
     * @return OfferResourceCollection
     */
    public function index(Request $request)
    {
        $query = Offer::query();
        if($request->has ('req_user_id') && $request->req_user_id <> 'null'){
            $query->where('req_user_id', '=', $request->req_user_id);
        }
        if($request->has ('res_user_id') && $request->res_user_id <> 'null'){
            $query->where('res_user_id', '=', $request->res_user_id);
        }
        if($request->has ('status1') && $request->status1 <> 'null' && $request->has ('status2') && $request->status2 <> 'null'){
            $query->orWhere('status', '=', $request->status1);
            $query->orWhere('status', '=', $request->status2);
        }
        if($request->has ('status') && $request->status <> 'null'){
            $query->where('status', '=', $request->status);
        }
        // dd($query->toSql());
        // error_log($request->req_user);
        $offer = $query->orderBy('id', 'desc')->paginate(15);
        return new OfferResourceCollection($offer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return OfferResource
     */
    public function store(OfferRequest $request)
    {
//      todo:manual validate or Request validate
        $offer = $request->all();
        if($offer->save()){
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
     * @param Request $request
     * @param $id
     */
    public function update(OfferRequest $request, $id)
    {
        $offerUpdate = Offer::findOrFail($id);
        $inputs = $request->all();
        $offerUpdate->fill($inputs)->save();
        return new OfferResource($offerUpdate);
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
