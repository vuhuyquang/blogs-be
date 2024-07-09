<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
  private $permissionService;

  public function __construct(PermissionService $permissionService)
  {
    $this->permissionService = $permissionService;
  }

  public function getAll(Request $request): JsonResponse
  {
    $page = $request->query('page', 1);
    $size = $request->query('size', 20);
    $search = $request->query('search');
    $response = $this->permissionService->getAll($page, $size, $search);
    return response()->json($response);
  }
}
