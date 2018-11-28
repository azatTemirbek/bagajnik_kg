<?php

namespace App\Http\Resources\RatingResources;

use App\Http\Resources\UserResources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingsResource extends JsonResource
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
//            'type' => 'ratings',
            'id' => (string)$this->id,
//            'attributes' => [
            'from_user_id' => $this->from_user_id,
            'to_user_id' => $this->to_user_id,
            'rate_value' => $this->rate_value,
            'comment' => $this->comment,
//            ],
            'relationships' => [
                'from_user' => new UserResource($this->from_user),
                'to_user' => new UserResource($this->to_user),
            ],
        ];
    }

}
