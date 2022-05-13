<?php

namespace DvSoft\EloquentSearchable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait EloquentSearchableTrait
{
    /**
     * @param Builder $query
     * @param ?string $keyword
     * @param boolean $matchAllFields
     * @return Builder
     */
    public static function scopeSearch(Builder $query, ?string $keyword, bool $matchAllFields = false): Builder
    {
        return $query->where(static function ($query) use ($keyword, $matchAllFields) {

            foreach (static::getSearchableFields() as $field) {
                if ($matchAllFields) {
                    $query->where($field, 'LIKE', "%$keyword%");
                } else {
                    $query->orWhere($field, 'LIKE', "%$keyword%");
                }
            }

        });
    }

    /**
     * Get all searchable fields
     *
     * @return array
     */
    public static function getSearchableFields(): array
    {
        $model = new static;

        $fields = $model->searchable;

        if (empty($fields)) {
            $fields = Schema::getColumnListing($model->getTable());

            $ignoredColumns = [
                $model->getKeyName(),
                $model->getUpdatedAtColumn(),
                $model->getCreatedAtColumn(),
            ];

            if (method_exists($model, 'getDeletedAtColumn')) {
                $ignoredColumns[] = $model->getDeletedAtColumn();
            }

            $fields = array_diff($fields, $model->getHidden(), $ignoredColumns);
        }

        return $fields;
    }
}
