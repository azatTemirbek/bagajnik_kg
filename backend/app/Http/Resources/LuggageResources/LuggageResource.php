<?php

namespace App\Http\Resources\LuggageResources;

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
            'type' => 'luggages',
            'id' => (string) $this->id,
            'attributes' => [
                'takerName' => $this->takerName,
                'takerPhone1' => (string)$this->takerPhone1,
                'takerPhone2' => (string)$this->takerPhone2,
                'mass' => $this->mass,
                'comertial' => $this->comertial,
                'value' => $this->value,
                'price' => $this->price,
                'from' => $this->from,
                'to' => $this->to,
                'start_dt' => $this->start_dt,
                'end_dt' => $this->end_dt,
            ],
            'relationships' => [
                'owner' => new UserResource($this->owner),
                'offer' => new LuggageResource($this->offer),

            ],
        ];
    }
}
