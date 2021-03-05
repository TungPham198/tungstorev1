<?php

namespace App\Repositories;

interface BaseInterface
{
    public function all();

    public function find($id, $relations = []);

    public function store(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function paginate($count);

    public function with($relations);

    public function where(array $where);
}

