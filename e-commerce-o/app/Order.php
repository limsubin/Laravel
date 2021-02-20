<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//완전히 삭제하지 않고 삭제된 것으로 표시하도록 허용(데이터 복원 유용)
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'product_id', 'user_id', 'quantity', 'address', 
    ];
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}