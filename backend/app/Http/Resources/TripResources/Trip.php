<?php

namespace App\Http\Resources\TripResources;

use Illuminate\Http\Resources\Json\JsonResource;

class Trip extends JsonResource
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
            'id' => $this->id,
            'carrier_id' => $this->carrier_id,
            'start_dt' => (string) $this->start_dt,
            'end_dt' => (string) $this->end_dt,
            'from' => $this->from,
            'to' => $this->to,
        ];
    }
}
