<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;

trait CreatedUpdatedBy
{
    /**
     * Return information about the user who created this record.
     * @param string $related
     * @param string $foreignKey
     * @param string $localKey
     * @return HasOne
     */
    public function createdBy(
        string $related = 'App\Models\User',
        string $foreignKey = 'id',
        string $localKey = 'created_by'
    ): HasOne
    {
        return $this->hasOne($related, $foreignKey, $localKey);
    }

    /**
     * Return information about the user who updated this record.
     * @param string $related
     * @param string $foreignKey
     * @param string $localKey
     * @return HasOne
     */
    public function updatedBy(
        string $related = 'App\Models\User',
        string $foreignKey = 'id',
        string $localKey = 'updated_by'
    ): HasOne
    {
        return $this->hasOne($related, $foreignKey, $localKey);
    }
}
