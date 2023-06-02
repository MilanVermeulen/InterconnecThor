<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

}
