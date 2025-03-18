<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResourse extends JsonResource
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
            'name' => $this->name,
            'quantity' => $this->quantity,
            'store_date' => $this->store_date,
            'type_quantity' => $this->type_quantity,
            'type_store' => $this->type_store,

        ];
    }
}
