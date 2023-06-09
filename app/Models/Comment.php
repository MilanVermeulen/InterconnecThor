<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{

    protected $fillable = [
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'comment_likes');
    }

}
