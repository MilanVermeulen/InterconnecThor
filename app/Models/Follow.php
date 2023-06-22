<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public $timestamps = true;

    /**
     * Get the owning followable model.
     */
    public function followable()
    {
        return $this->morphTo();
    }

}
