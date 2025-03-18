<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LandResourse extends JsonResource {

    public function toArray( $request ) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'area' => $this->area,
            'supervisor' => $this->supervisor->name,
        ];
    }
}

