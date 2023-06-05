<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'category_student')->withTimestamps();
    }    

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
