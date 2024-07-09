<?php

namespace App\Repositories\Implements;

use App\Repositories\Interfaces\UserRoleRepositoryInterface;
use App\Models\UserRole;

class UserRoleRepository extends BaseRepository implements UserRoleRepositoryInterface
{
  public function __construct()
  {
    parent::__construct(UserRole::class);
    $this->fields = UserRole::FIELDS;
  }
}
