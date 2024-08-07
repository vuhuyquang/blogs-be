<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function getAll(): JsonResponse
    {
        $response = $this->blogService->getAll();
        return response()->json($response);
    }
}
