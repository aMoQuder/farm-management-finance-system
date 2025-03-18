<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $fillable = [
        'title','description','image'
    ];
}
