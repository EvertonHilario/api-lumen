<?php

namespace App\Infrastructure\Eloquent;

use App\Domain\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**      
     * BaseRepository constructor.
     *      
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @return Bool
     */
    public function delete(Model $model): Bool
    {
        return $model->delete();
    }

    /**
     * @param Model $model
     * @param array $attributes
     * @return Bool
     */
    public function update(Model $model, array $attributes): Bool
    {
        return $model->update($attributes);
    }
}
