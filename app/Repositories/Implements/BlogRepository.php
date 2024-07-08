<?php

namespace App\Repositories\Implements;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
  public function __construct()
  {
    parent::__construct(Blog::class);
    $this->fields = Blog::FIELDS;
  }

  public function getPostList(int $page, int $size): LengthAwarePaginator
  {
    return $this->getModel()::join('categories', function ($join) {
      $join->on('blogs.category_id', '=', 'categories.id')
        ->where('categories.status', 1);
    })
      ->select('blogs.*', 'categories.category as category_name')
      ->orderBy('blogs.created_at', 'desc')
      ->paginate($size, ['*'], 'page', $page);
  }
}
