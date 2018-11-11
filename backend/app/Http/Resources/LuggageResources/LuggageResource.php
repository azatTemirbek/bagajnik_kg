<?php

namespace App\Http\Resources\LuggageResources;

use App\Http\Resources\OfferResources\OfferResource;
use App\Http\Resources\UserResources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LuggageResource extends JsonResource
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
//            'type' => 'luggages',
            'id' => (string) $this->id,
//            'attributes' => [
                'takerName' => $this->takerName,
                'takerPhone1' => (string)$this->takerPhone1,
                'takerPhone2' => (string)$this->takerPhone2,
                'mass' => $this->mass,
                'comertial' => $this->comertial,
                'value' => $this->value,
                'price' => $this->price,
                'from_lat' => $this->from_lat,
                'from_lng' => $this->from_lng,
                'from_formatted_address' => $this->from_formatted_address,
                'from_place_id' => $this->from_place_id,
                'to_lat' => $this->to_lat,
                'to_lng' => $this->to_lng,
                'to_formatted_address' => $this->to_formatted_address,
                'to_place_id' => $this->to_place_id,
                'start_dt' => (string) $this->start_dt,
                'end_dt' => (string) $this->end_dt,
//            ],
            'relationships' => [
                'owner' => new UserResource($this->owner),
               // 'offer' => new OfferResource($this->offer),

            ],
        ];
    }
}
