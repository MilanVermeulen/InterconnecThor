<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

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
    
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'streetnr', 'postal_code', 'city', 'country', 'password', "profile_picture"
    ];

    protected $hidden = [
        'password',
    ];
}