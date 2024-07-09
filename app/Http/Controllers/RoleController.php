<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  private $roleService;

  public function __construct(RoleService $roleService)
  {
    $this->roleService = $roleService;
  }

  public function getAll(Request $request): JsonResponse
  {
    $page = $request->query('page', 1);
    $size = $request->query('size', 20);
    $search = $request->query('search');
    $response = $this->roleService->getAll($page, $size, $search);
    return response()->json($response);
  }

  public function create(CreateRoleRequest $request)
  {
    $response = $this->roleService->create($request);
    return response()->json($response);
  }
}
