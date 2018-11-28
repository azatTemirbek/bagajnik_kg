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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'carrier_id' => $this->carrier_id,
            'start_dt' => (string)$this->start_dt,
            'end_dt' => (string)$this->end_dt,
            'from_formatted_address' => $this->from_formatted_address,
            'to_formatted_address' => $this->to_formatted_address,
            'relationships' => [
                'carrier' => new UserResource($this->carrier),
                //'offers' => new OfferResource($this->offers)
            ],

        ];
    }
}
