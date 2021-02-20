<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myboard extends Model
{
    //protected $table="bbs";
    //배열로 저장, 수정할 수 있는 칼럼을 리스트로 무조건 정의해주어야한다
    public $fillable = ['Title', 'Writer', 'Content', 'Hits'];
    //public $guarded = ['Title'];
    //public $timestamps = false;
    protected $primaryKey = 'Num'; 
    protected $dates=['Regtime'];//데이터타입의 칼럼을 해주고
    public $timestamps = false; //timestamps를 안쓴다고 기제

    public function updateMsg($num, $title, $writer, $content){
        Myboard::find($num)->udpate(['Title'=>$title, 'Writer'=>$writer, 'Content'=>$content]);
    }
}
