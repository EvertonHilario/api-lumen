<?php

namespace App\Domain\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find(int $id): ?Model;

    /**
     * @param $id
     * @return Void
     */
    public function detete(int $id): Void;

    /**
     * @param Model $model
     * @param array $attributes
     * @return Bool
     */
    public function update(Model $model, array $attributes): Bool;
}
