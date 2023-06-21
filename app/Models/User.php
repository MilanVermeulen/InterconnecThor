<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'streetnr',
        'postal_code',
        'city',
        'country',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user')
            ->withPivot('start_year', 'end_year')
            ->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_user')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function follows()
    {
        return $this->morphedByMany(User::class, 'followable', 'follows');
    }

    public function follow(User $user)
    {
        if (!$this->isFollowing($user)) {
            return $this->follows()->save($user);
        }
    }

    public function unfollow(User $user)
    {
        if ($this->isFollowing($user)) {
            return $this->follows()->detach($user);
        }
    }

    public function isFollowing(User $user)
    {
        return $this->follows->contains($user);
    }

    public function isConnectedWith(User $user)
    {
        return $this->isFollowing($user) && $user->isFollowing($this);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followable_id', 'user_id')
            ->where('followable_type', User::class);
    }

    public function getFollowerCountAttribute()
    {
        return $this->followers()->count();
    }

    public function connections()
    {
        return $this->follows()
            ->whereHas('follows', function ($query) {
                $query->where('followable_id', $this->id)
                    ->where('followable_type', User::class);
            })->get();
    }

    public function getConnectionsCountAttribute()
    {
        return $this->connections()->count();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'followable_id')
            ->where('followable_type', User::class);
    }

    public function getFollowingCountAttribute()
    {
        return $this->following()->count();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

}
