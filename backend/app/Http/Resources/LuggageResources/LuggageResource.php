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
                'from_formatted_address' => $this->from_formatted_address,
                'to_formatted_address' => $this->to_formatted_address,
                'start_dt' => (string) $this->start_dt,
                'end_dt' => (string) $this->end_dt,
                'dsc' => (string) $this->dsc,
                'owner_id' => $this->owner_id,
//            ],
            'relationships' => [
                'owner' => new UserResource($this->owner),
               // 'offer' => new OfferResource($this->offer),

            ],
        ];
    }
}
