<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function exercise(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
