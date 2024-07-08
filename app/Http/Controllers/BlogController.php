<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function getAll(Request $request)
    {
        $page = $request->query('page', 1);
        $size = $request->query('size', 20);
        $response = $this->blogService->getAll($page, $size);
        return response()->json($response);
    }
}
