<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Contest extends BaseModel
{
    protected $fillable = [
        'name',
        'started_at',
        'ended_at',
        'city',
        'state',
        'country',
    ];

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }
}
