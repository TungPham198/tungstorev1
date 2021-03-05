<?php

namespace App\Repositories;

class BaseRepository implements BaseInterface
{
    protected $modelName;

    /**
     * Return all resources
     *
     * @return mixed
     */
    public function all()
    {
        $instance = $this->getNewInstance();
        return $instance->all();
    }

    /**
     * Find resource with relations
     *
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function find($id, $relations = [])
    {
        $instance = $this->getNewInstance();
        return $instance->find($id);
    }

    /**
     * Create new resource into database
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        $instance = $this->getNewInstance();
        return $instance->create($data);
    }

    /**
     * Update special resource via id
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $record = $this->getNewInstance()->find($id);
        return $record->update($data);
    }

    /**
     * Delete special resource from database
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $instance = $this->getNewInstance();
        return $instance->destroy($id);
    }

    /**
     * Return resource with relations
     *
     * @param $relations
     * @return mixed
     */
    public function with($relations)
    {
        $instance = $this->getNewInstance();
        return $instance->with($relations);
    }

    /**
     * Paginate resource
     *
     * @param $count
     * @return mixed
     */
    public function paginate($count)
    {
        $instance = $this->getNewInstance();
        return $instance->paginate($count);
    }

    /**
     * Find resource using key and value
     *
     * @param array $where
     * @return mixed
     */
    public function where(array $where)
    {
        $instance = $this->getNewInstance();
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                return $instance = $instance->where($field, $condition, $val);
            } else {
                return $instance = $instance->where($field, '=', $value);
            }
        }
        return $instance;
    }

    /**
     * Get type
     *
     * @return mixed
     */
    public function getType()
    {
        $instance = $this->getNewInstance();
        return $instance->type;
    }

    /**
     * Return instance
     *
     * @return mixed
     */
    protected function getNewInstance()
    {
        $model = $this->modelName;
        return new $model;
    }
}
