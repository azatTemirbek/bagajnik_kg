<?php

namespace App\Http\Resources\OfferResources;

use App\Http\Resources\LuggageResources\LuggageResource;
use App\Http\Resources\TripResources\TripsResource;
use App\Http\Resources\UserResources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
//            'type' => 'offers',
            'id' => (string) $this->id,
//            'attributes' => [
            'agree' => $this->agree,
            'status' => $this->status,
            'req_user_id' => $this->req_user_id,
            'res_user_id' => $this->res_user_id,
            'luggage_id' => $this->luggage_id,
            'trip_id' => $this->trip_id,
//            ],
            'relationships' => [
                'trip' => new TripsResource($this->trip),
                'luggage' => new LuggageResource($this->luggage),
                'req_user' => new UserResource($this->req_user),
                'res_user' => new UserResource($this->res_user)
            ],
        ];
    }
}
