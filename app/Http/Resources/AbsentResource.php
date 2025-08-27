<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AbsentResource extends JsonResource {

    public function toArray( $request ) {
        return [
            $this->date => $this->worker->name,
        ];
    }
}
