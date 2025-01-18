<?php

namespace App\LaravelRestToolkit\Repositories;

abstract class Repository
{
    protected $model;

    /**
     * Define the model class.
     *
     * @return string
     */
    abstract public function model();

    /**
     * Initialize the model.
     */
    public function __construct()
    {
        $this->model = app($this->model());
    }

    /**
     * Get all records ordered by id descending.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    /**
     * Load relationships for the model.
     *
     * @param array|string $relations
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    /**
     * Paginate records.
     *
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit = 15)
    {
        return $this->model->orderBy('id', 'desc')->paginate($limit);
    }

    /**
     * Get records by a specific column value.
     *
     * @param string $col
     * @param mixed $value
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBy($col, $value, $limit = 15)
    {
        return $this->model->where($col, $value)->limit($limit)->get();
    }

    /**
     * Create a new record.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Find a record by id.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Update a record.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $data
     * @return bool
     */
    public function update($model, array $data)
    {
        return $model->update($data);
    }

    /**
     * Delete a record.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool|null
     */
    public function delete($model)
    {
        return $model->delete();
    }

    /**
     * Check if a record exists by id.
     *
     * @param int $id
     * @return bool
     */
    public function exists($id)
    {
        return $this->model->where('id', $id)->exists();
    }

    /**
     * Get a query builder instance.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->query();
    }
}
