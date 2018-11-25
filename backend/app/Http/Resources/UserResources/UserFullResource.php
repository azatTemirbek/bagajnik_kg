<?php

namespace App\Http\Resources\UserResources;

use App\Http\Resources\LuggageResources\LuggageResourceCollection;
use App\Http\Resources\OfferResources\OfferResourceCollection;
use App\Http\Resources\RatingResources\RatingsResourceCollection;
use App\Http\Resources\TripResources\TripsResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFullResource extends JsonResource
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
            'ratingsToMe' => new RatingsResourceCollection($this->ratingsToMe),
            'myRatings' => new RatingsResourceCollection($this->myRatings),
            'offers' => new OfferResourceCollection($this->offers),
            'trips' => new TripsResourceCollection($this->trips),
            'luggages' => new LuggageResourceCollection($this->luggages),
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
