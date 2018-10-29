<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResources\OfferResource;
use App\Http\Resources\OfferResources\OfferResourceCollection;
use App\Offer;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;
use Tymon\JWTAuth\Validators\Validator;

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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return OfferResource
     */
    public function store(Request $request, $id)
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
        $store = Offer::where('id', $id)->store($request->all());

        $response = array(
            "result" => ""
        );
        if($store == 1){
            $response["result"] = "Successfully stored";
        } else {
            $response["result"] = "Failed to store. Something went wrong";
        }

        return $response.toJSON();
//      todo:manual validate or Request validate
//        $offer = new Offer($request->all());
//        $status = $request->get("status");
//        $agree = $request->get("agree");
//        if ($offer->save()) {
//            return New OfferResource($offer);
//        }
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
    public function update(Request $request, $id)
    {
//        //    todo:validate
////       Todo: Update implemantation
//        $request->
//        $validate = $request->validate([
//            'agree' => 'min:0|max:1',
//            'status' => 'in:received,progress,delivered)',
//            ]);
//
        //

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
