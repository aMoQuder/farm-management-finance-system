<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CropResourse extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'seed_quantity' => $this->seed_quantity,
            'type_quantity' => $this->type_quantity,
            'seed_price' => $this->seed_price,
            'seed_acquired_date' => $this->seed_acquired_date,
        ];    }
}
