<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public $fillable = ['Title', 'Writer', 'Content'];
    public $timestamps = false;
}
