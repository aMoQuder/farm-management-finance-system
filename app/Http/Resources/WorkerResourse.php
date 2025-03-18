<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResourse extends JsonResource
{

    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "salary" => $this->salary,
            "expenses" => $this->expenses,
        ];
    }
}
