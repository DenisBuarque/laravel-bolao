<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Permission;

class PermissionRepository extends AbstractRepository implements PermissionRepositoryInterface
{
    protected $model = Permission::class;

    // aqui fica as funções que pertenção somente a esse modelo...
    
}