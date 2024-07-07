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

  public function getAll($page, $size, $search): array
  {
    try {
        $response = $this->blogRepository->select(['id', 'title', 'slug', 'short_content', 'category_id', 'author_id', 'reading_time', 'created_at'], $search, ['title', 'slug'], 'id', 'DESC', $page, $size, []);
        return $this->transformData(true, "Lấy danh sách bài viết thành công.", $response);
    } catch (\Exception $e) {
      Log::error($e->getMessage());
      return $this->transformData(false, $e->getMessage(), [], 400);
    }
  }
}
