<?php

namespace App;

class Post extends Model
{
    //protected $fillable =['title', 'body'];   // fillable will whitelist the field to be submitted
    //protected $guarded = [];                  // inverse of fillable, do not allow this field to be submitted.

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
