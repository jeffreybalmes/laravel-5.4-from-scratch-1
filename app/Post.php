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
}
