<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;

class UserService extends BaseService
{
  private $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function getAll($page, $size, $search): array
  {
    try {
      $response = $this->userRepository->select(['id', 'username', 'fullname', 'email', 'status', 'avatar', 'created_at'], $search, ['username', 'fullname', 'email'], 'id', 'DESC', $page, $size, []);
      return $this->transformData(true, "Lấy danh sách người dùng thành công.", $response);
    } catch (\Exception $e) {
      Log::error($e->getMessage());
      return $this->transformData(false, $e->getMessage(), [], 400);
    }
  }
}
