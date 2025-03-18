<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkerGroupResourse extends JsonResource
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
        'Land_id' => $this->land_id,
        'type_work' => $this->type_work,
        'work' => $this->work,
        'worker_count' => $this->worker_count,
        'daily_wage' => $this->daily_wage,
        'work_date' => $this->work_date,
    ];
    }
}
