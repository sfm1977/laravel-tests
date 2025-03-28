<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];

    protected $dates = [
        'dob'
    ];

    public function  setDobAttribute($dob)
    {
        return $this->attributes['dob'] = Carbon::parse($dob);
    }
}
