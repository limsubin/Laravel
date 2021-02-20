<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = false;
    //public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_sequence', 'id', 'product_code', 'quantity', 'indate', 'order_code' 
    ];

    public function user(){
        return $this->belongsTo(User::class, 'email');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_code');
    }
}
