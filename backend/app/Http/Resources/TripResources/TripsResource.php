<?php

namespace App\Http\Resources\TripResources;

use App\Http\Resources\OfferResources\OfferResource;
use App\Http\Resources\UserResources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TripsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
//            'type' =>'trips',
            'id' =>(string) $this->id,
//            'attributes' => [
                'carrier_id' => $this->carrier_id,
                'start_dt' =>  (string)  $this->start_dt,
                'end_dt' => (string) $this->end_dt,
                // 'from_lat' => $this->from_lat,
                // 'from_lng' => $this->from_lng,
                'from_formatted_address' => $this->from_formatted_address,
                // 'from_place_id' => $this->from_place_id,
                // 'to_lat' => $this->to_lat,
                // 'to_lng' => $this->to_lng,
                'to_formatted_address' => $this->to_formatted_address,
                // 'to_place_id' => $this->to_place_id,
//            ],
            'relationships' => [
                'carrier' => new UserResource($this->carrier),
                //'offers' => new OfferResource($this->offers)
            ],

        ];
    }
}
