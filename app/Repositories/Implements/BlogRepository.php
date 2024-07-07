<?php

namespace App\Repositories\Implements;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
  public function __construct()
  {
    parent::__construct(Blog::class);
    $this->fields = Blog::FIELDS;
  }
}
