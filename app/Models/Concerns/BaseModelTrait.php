<?php

namespace App\Models\Concerns;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

/** @mixin BaseModel */
trait BaseModelTrait
{
    protected function label(): Attribute
    {
        return Attribute::make(function (): string {
            if (isset($this->attributes['label'])) {
                return $this->attributes['label'];
            }

            return $this->getLabel();
        });
    }

    public function getLabel(): string
    {
        if (isset($this->increment_id)) {
            return $this->increment_id;
        }

        $type = (isset($this->type) && is_string($this->type))
            ? $this->type
            : class_basename(static::class);

        return $type.' #'.$this->getKey();
    }

    public function getOriginalModel(): static
    {
        return (new static)->setRawAttributes($this->original, true);
    }

    public function freshWithScopes($with = []): ?static
    {
        if (! $this->exists) {
            return null;
        }

        /** @phpstan-ignore-next-line  */
        return $this->newQuery()
            ->where($this->getTable().'.'.$this->getKeyName(), $this->getKey())
            ->with(is_string($with) ? func_get_args() : $with)
            ->first();
    }
}
