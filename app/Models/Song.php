<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Song extends BaseModel
{
    protected $fillable = [
        'title',
        'arranger',
        'original_lyricist',
        'original_music',
    ];

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }
}
