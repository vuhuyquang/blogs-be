<?php

namespace App\Services;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Facades\Log;

class PermissionService extends BaseService
{
  private $permissionRepository;

  public function __construct(PermissionRepositoryInterface $permissionRepository)
  {
    $this->permissionRepository = $permissionRepository;
  }

  public function getAll($page, $size, $search): array
  {
    try {
      $response = $this->permissionRepository->select(['id', 'name'], $search, ['name'], 'id', 'DESC', $page, $size, []);
      return $this->transformData(true, "Lấy danh sách quyền thành công.", $response);
    } catch (\Exception $e) {
      Log::error($e->getMessage());
      return $this->transformData(false, $e->getMessage(), [], 400);
    }
  }
}
