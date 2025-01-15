<?php

namespace App\Models;

use App\Extensions\EloquentBuilder;
use App\Models\Concerns\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Tappable;

/**
 * @property-read string $label
 */
class BaseModel extends Model
{
    use BaseModelTrait, Conditionable, Tappable;

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query): EloquentBuilder
    {
        return new EloquentBuilder($query);
    }

    public function scopeForScout($q)
    {
        if (! method_exists($this, 'makeAllSearchableUsing')) {
            throw new \Exception('You must use the Searchable trait to use this method');
        }

        return $this->makeAllSearchableUsing($q);
    }

    public function getSearchableSettings(): array
    {
        return [];
    }

    public function getRawAttribute($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function getExportable()
    {
        if (isset($this->exportable)) {
            return $this->exportable;
        }

        return Schema::getColumnListing($this->getTable());
    }

    /**
     * Had to override this because it was storing date as UTC instead of as the timezone of app.
     *
     * @param  mixed  $value
     * @return mixed|string|null
     */
    public function fromDateTime($value)
    {
        return empty($value) ? $value : $this->asDateTime($value)->tz(config('app.timezone'))->format(
            $this->getDateFormat()
        );
    }

    public function fillMissing($data): self
    {
        $new = array_diff_key($data, array_filter($this->attributes));

        return $this->fill($new);
    }

    public function forceFillMissing($data): self
    {
        $new = array_diff_key($data, array_filter($this->attributes));

        return $this->forceFill($new);
    }

    public function saveAndReturn(): self
    {
        $this->save();

        return $this;
    }

    public static function morphClass(): string
    {
        return (new static)->getMorphClass();
    }
}
