<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quartet extends BaseModel
{
    protected $fillable = [
        'name',
        'active',
        'gender',
        'organization_id',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
