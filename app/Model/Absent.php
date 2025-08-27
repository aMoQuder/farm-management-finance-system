<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    // use HasFactory;

    protected $fillable = [
        'worker_id',
        'date',
    ];

    // العلاقة بين الغياب والموظف
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
