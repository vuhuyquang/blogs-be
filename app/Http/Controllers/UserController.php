<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
  private $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function getAll(Request $request)
  {
    $page = $request->query('page', 1);
    $size = $request->query('size', 1);
    $search = $request->query('search');
    $response = $this->userService->getAll($page, $size, $search);
    return response()->json($response);
  }
}
