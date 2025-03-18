<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenCompanyResourse extends JsonResource
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
            'receiver' => $this->receiver,
            'amount' => $this->amount, // تأكد أن هذا الحقل يخزن المبلغ وليس cash_id
            'date' => $this->date,
            'reason' => $this->reason,
        ];
    }
}
