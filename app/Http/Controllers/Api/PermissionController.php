<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Permission::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('display_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $permissions = $query->orderBy('module')->orderBy('name')->paginate($request->get('per_page', 50));

        return response()->json($permissions);
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->validated());

        return response()->json($permission, 201);
    }

    public function show(Permission $permission)
    {
        return response()->json($permission);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return response()->json($permission);
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles()->count() > 0) {
            return response()->json([
                'message' => 'Cannot delete permission that is assigned to roles'
            ], 422);
        }

        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully']);
    }

    public function getByModule($module)
    {
        $permissions = Permission::where('module', $module)->get();

        return response()->json($permissions);
    }
}
