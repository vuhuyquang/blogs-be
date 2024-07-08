<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
interface BlogRepositoryInterface extends BaseRepositoryInterface
{
    public function getPostList(int $page, int $size): LengthAwarePaginator;
}
