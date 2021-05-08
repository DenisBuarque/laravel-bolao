<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function all($column = 'id', $order = 'ASC');
    public function paginate($paginate = 10, $column = 'id', $order = 'ASC');
    public function findWereLike($columns, $search, $column, $order);
    public function find($id);
    public function update($dados, $id);
    public function delete($id);
}