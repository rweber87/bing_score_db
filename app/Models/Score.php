<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends BaseModel
{
    protected $fillable = [
        'quartet_id',
        'song_id',
        'contest_id',
        'category_id',
        'score',
    ];

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class, 'song_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function contest(): BelongsTo
    {
        return $this->belongsTo(Contest::class, 'contest_id');
    }
}
