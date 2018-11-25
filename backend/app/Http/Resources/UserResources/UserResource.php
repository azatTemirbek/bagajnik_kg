<?php

namespace App\Http\Resources\UserResources;

use App\Http\Resources\LuggageResources\LuggageResource;
use App\Http\Resources\OfferResources\OfferResource;
use App\Http\Resources\RatingResources\RatingsResource;
use App\Http\Resources\RatingResources\RatingsResourceCollection;
use App\Http\Resources\TripResources\TripsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
//            'type' => 'user',
            'id' => (string) $this->id,
//            'attributes' => [
                'name' => $this->name,
                'surname' => $this->surname,
                'phone' =>$this->phone,
                'email' =>$this->email,
                'fullName' => $this->getFullname(),
//            ],
          'relationships' => [
            'rating' => new RatingsResource($this->rating),
            'offer' => new OfferResource($this->offer),
            'trip' => new TripsResource($this->trip),
          ],
        ];
    }
    /**
     * to get full name of the user
     */
    public function getFullname(){
        return $this->name.' '. $this->surname;;
    }
}
