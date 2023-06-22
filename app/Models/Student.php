<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'streetnr', 'postal_code', 'city', 'country', 'password', "profile_picture"
    ];
    protected $hidden = [
        'password',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student')
            ->withPivot('start_year', 'end_year')
            ->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_student')->withTimestamps();
    }
}
