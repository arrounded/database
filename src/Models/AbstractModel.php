<?php
namespace Arrounded\Database\Models;

use Arrounded\Database\Collection;
use Arrounded\Database\Interfaces\ValidatableInterface;
use Arrounded\Reflection\Entities\Traits\ReflectionModel;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model implements ValidatableInterface
{
    use ReflectionModel;

    /**
     * The attributes to cast on serialization.
     *
     * @type array
     */
    protected $casts = [
        'integer' => ['id'],
    ];

    //////////////////////////////////////////////////////////////////////
    /////////////////////////// RELATED CLASSES //////////////////////////
    //////////////////////////////////////////////////////////////////////

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param array $models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

    //////////////////////////////////////////////////////////////////////
    /////////////////////////////// SCOPES ///////////////////////////////
    //////////////////////////////////////////////////////////////////////

    /**
     * Order entries in a specific order.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $field
     * @param array                                 $values
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByField($query, $field, $values)
    {
        return $query->orderByRaw($field.' <> "'.implode('", '.$field.' <> "', $values).'"');
    }

    /**
     * Get all models belonging to other models.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $relation
     * @param array                                 $ids
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereBelongsTo($query, $relation, array $ids = [])
    {
        $ids = $ids ?: ['void'];

        return $query->whereIn($relation.'_id', $ids);
    }
}
