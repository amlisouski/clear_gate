<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait RelationsMap
{
    public function supportedRelations(): array
    {
        return [];
    }

    public function withAll(Builder $query): Builder
    {
        return $query->with($this->supportedRelations());
    }
}
