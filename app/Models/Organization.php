<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends BaseModel
{
    protected $fillable = [
        'name',
        'country',
    ];

    public function quartets(): HasMany
    {
        return $this->hasMany(Quartet::class);
    }
}
