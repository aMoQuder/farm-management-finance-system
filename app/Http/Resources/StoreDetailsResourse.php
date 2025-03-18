<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreDetailsResourse extends JsonResource {
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */

    public function toArray( $request ) {
        return [
        'getter_name' => $this->getter_name,
        'get_date' => $this->get_date,
        'quantity' => $this->quantity,
        'land_id' => $this->land_id,
        'crop_id' => $this->crop_id, ];
    }
}
