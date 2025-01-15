<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quartet extends BaseModel
{
    protected $fillable = [
        'name',
        'active',
        'gender',
        'organization_id',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }
}
