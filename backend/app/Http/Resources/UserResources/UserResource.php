<?php

namespace App\Http\Resources\UserResources;

use App\Http\Resources\LuggageResources\LuggageResource;
use App\Http\Resources\OfferResources\OfferResource;
use App\Http\Resources\RatingResources\RatingsResource;
use App\Http\Resources\RatingResources\RatingsResourceCollection;
use App\Http\Resources\TripResources\TripsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * TODO: remove localhost on production
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
                'photo' => 'http://localhost:8000'.Storage::url($this->photo),
                'fullName' => $this->getFullname(),
                'avarageRating' => $this->avarageRating(),
                'numberOfSentLuggagesWithMe' => $this->numberOfSentLuggagesWithMe(),
                'numberOfSentLuggagesIHaveSent' => $this->numberOfSentLuggagesIHaveSent(),
//            ],
        //   'relationships' => [
        //     'rating' => new RatingsResource($this->rating),
        //     'offer' => new OfferResource($this->offer),
        //     'trip' => new TripsResource($this->trip),
        //   ],
        ];
    }
    /**
     * to get full name of the user
     */
    public function getFullname(){
        return $this->name.' '. $this->surname;
    }
    /**
     * number of luggages user have send throught this system
     */
    public function numberOfSentLuggagesIHaveSent()
    {
        $listOfOffresrs = $this->myOffers->where('agree', '=', '1');

        $emptyList = [];
        foreach ($listOfOffresrs as $offer) {
            if($offer->luggage_id) {
                $currentLuggage = $offer->luggage;
                if($currentLuggage->owner_id == $this->id){
                    array_push($emptyList,$currentLuggage);
                }
            }
        }
        return sizeof($emptyList);
    }

    /**
     * number of luggages carried with current user
     */
    public function numberOfSentLuggagesWithMe()
    {
        $listOfOffresrs = $this->myOffers->where('agree', '=', '1');

        $emptyList = [];
        foreach ($listOfOffresrs as $offer) {
            if($offer->luggage_id) {
                $currentLuggage = $offer->luggage;
                if($currentLuggage->owner_id != $this->id){
                    array_push($emptyList,$currentLuggage);
                }
            }
        }
        return sizeof($emptyList);
    }
}
