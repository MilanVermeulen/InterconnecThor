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
        return $this->belongsToMany('App\Models\Course');
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'streetnr', 'postal_code', 'city', 'country', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}