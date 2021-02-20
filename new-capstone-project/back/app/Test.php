<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table='emotion_value';
    protected $fillable = ['value'];
}
