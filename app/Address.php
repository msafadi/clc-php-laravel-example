<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
