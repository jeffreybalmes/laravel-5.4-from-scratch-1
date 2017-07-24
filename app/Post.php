<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =['title', 'body']; // fillable will whitelist the field to be submitted
    //protected $guarded = [];              // inverse of fillable, do not allow this field to be submitted.
}
