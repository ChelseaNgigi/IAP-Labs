<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
public function car(){
    return $this->hasMany(Review::class);
}
}
