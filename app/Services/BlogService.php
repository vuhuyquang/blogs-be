<?php

namespace App\Services;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use Illuminate\Support\Facades\Log;

class BlogService extends BaseService
{
  private $blogRepository;

  public function __construct(BlogRepositoryInterface $blogRepository)
  {
    $this->blogRepository = $blogRepository;
  }

  public function getAll(): array
  {
    try {
      $page = 1;
      $size = 3;
      $response = $this->blogRepository->getPostList($page, $size);
      return $this->transformData(true, "Lấy danh sách bài viết thành công.", $response);
    } catch (\Exception $e) {
      Log::error($e->getMessage());
      return $this->transformData(false, $e->getMessage(), [], 400);
    }
  }
}
