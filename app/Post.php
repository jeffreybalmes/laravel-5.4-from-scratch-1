<?php

namespace App;

use Carbon\Carbon;

class Post extends Model
{
    //protected $fillable =['title', 'body'];   // fillable will whitelist the field to be submitted
    //protected $guarded = [];                  // inverse of fillable, do not allow this field to be submitted.

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Post belongs to User
     * $post->user->name to get the name of User who created the post.
     * $comment->post->user to get user of the post in which the comment is associated with.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addComment($body)
    {
        $this->comments()->create(compact('body'));
//        Comment::create([
//            'body' => $body,
//            'post_id' => $this->id
//        ]);
    }

    public function scopeFilter($query, $filters)
    {
        if ($month = $filters['month']) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if ($year = $filters['year']) {
            $query->whereYear('created_at', $year);
        }
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at)')
            ->get()
            ->toArray();
    }

    public function tags()
    {
        // any post can belong to any tag
        return $this->belongsToMany(Tag::class);
    }
}
