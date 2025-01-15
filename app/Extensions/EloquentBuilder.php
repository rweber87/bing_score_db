<?php

namespace App\Extensions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class EloquentBuilder extends Builder
{
    /**
     * Add the "has" condition where clause to the query.
     * Overriding this method to call special "withoutSelectGlobalScopes" method.
     *
     * @param  string  $operator
     * @param  int  $count
     * @param  string  $boolean
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    protected function addHasWhere(Builder $hasQuery, Relation $relation, $operator, $count, $boolean)
    {
        $hasQuery->withoutSelectGlobalScopes()->mergeConstraintsFrom($relation->getQuery());

        return $this->canUseExistsForExistenceCheck($operator, $count)
            ? $this->addWhereExistsQuery($hasQuery->toBase(), $boolean, $operator === '<' && $count === 1)
            : $this->addWhereCountQuery($hasQuery->toBase(), $operator, $count, $boolean);
    }
}
