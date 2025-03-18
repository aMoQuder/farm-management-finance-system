<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MachineJobResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'machine_name' => $this->machine_name,
            'Count_hour' => $this->Count_hour,
            'Work_name' => $this->Work_name,
            'driver_id' => $this->driver_id,
            'Work_day' => $this->Work_day,
        ];
    }
}
