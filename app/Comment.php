<?php

namespace App;


class Comment extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Comment belongs to a User.
     *  $comment->user->name to get name of the User who created the comment.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}