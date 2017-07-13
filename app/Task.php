<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // regular static function which returns the result of the query.
    public static function incomplete()
    {
        return static::where('completed', 0)->get();
    }

    // using a query score(wrapper around query), multiple chains can be added into the query.
    public function scopeIncomplete($query)       // allow us to do: Task::incomplete() same as above with param
    {
        return $query->where('completed', 0);
    }
}
