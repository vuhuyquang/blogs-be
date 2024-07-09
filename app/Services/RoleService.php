<?php

namespace App\Services;

use App\Http\Requests\CreateRoleRequest;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleService extends BaseService
{
  private $roleRepository;

  public function __construct(RoleRepositoryInterface $roleRepository)
  {
    $this->roleRepository = $roleRepository;
  }

  public function getAll($page, $size, $search): array
  {
    try {
      $response = $this->roleRepository->select(['id', 'name'], $search, ['name'], 'id', 'DESC', $page, $size, []);
      return $this->transformData(true, "Lấy danh sách vai trò thành công.", $response);
    } catch (\Exception $e) {
      Log::error($e->getMessage());
      return $this->transformData(false, $e->getMessage(), [], 400);
    }
  }

  public function create(CreateRoleRequest $request): array
  {
    try {
      // DB::beginTransaction();
      $params = $request->except('_token');
      
      dd($params);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error($e->getMessage());
      return $this->transformData(false, $e->getMessage(), [], 400);
    }
  }
}
