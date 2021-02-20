<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customcard extends Model
{
    protected $table='customcard';
    protected $primaryKey = 'custom_number';
    public $timestamps = false;
    protected $fillable = ['custom_number', 'num', 'user_id', 'customcard_name', 'positive_perfume','positive_strength', 'normal_perfume', 'normal_strength', 'nagative_perfume', 'nagative_strength', 'rgb', 'bright'];
}
