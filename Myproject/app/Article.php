<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Taggable;
use Laravelista\Comments\Commentable;

class Article extends Model
{
   use \Conner\Tagging\Taggable;
   use Commentable;

   protected $fillable = ['id','title', 'writer', 'content', 'inquiry', 'good', 'favorites'];
   protected $dates=['Regtime'];
   public $timestamps = false;

   public function tags() { 
       return $this->belongsToMany(Tag::class); 
   } 

   public function user(){
     return $this->belongsTo(User::class);
   }
}
