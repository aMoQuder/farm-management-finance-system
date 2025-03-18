<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FertilizerResourse extends JsonResource
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
            'fertilizer_name' => $this->fertilizer_name,
            'amount' => $this->amount,
            'application_date' => $this->application_date,
            'crop_id' => $this->crop_id,
          
        ];    }
}
