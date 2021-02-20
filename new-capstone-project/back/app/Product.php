<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';//'product'
    //protected $fillable = ['user_id', 'name', 'price', 'description', 'image'];
    protected $primaryKey = 'product_code';
    public $timestamps = false;
    protected $fillable = ['product_code', 'product_name', 'aroma_name', 'product_img', 'product_color', 'product_price', 'product_content', 'product_quantity', 'indate'];

    public function orders(){
        return $this->hasMany(Order::class, 'id');
    }
}
