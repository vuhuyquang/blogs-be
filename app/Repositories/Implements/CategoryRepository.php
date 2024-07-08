<?php

namespace App\Repositories\Implements;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
  public function __construct()
  {
    parent::__construct(Category::class);
    $this->fields = Category::FIELDS;
  }
}
