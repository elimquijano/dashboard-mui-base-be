<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $query = Module::with('parent');

        if ($request->has('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('description', 'like', "%{$request->search}%");
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $modules = $query->orderBy('sort_order')->paginate($request->get('per_page', 50));

        return response()->json($modules);
    }

    public function store(StoreModuleRequest $request)
    {
        $module = Module::create($request->validated());

        return response()->json($module->load('parent'), 201);
    }

    public function show(Module $module)
    {
        return response()->json($module->load(['parent', 'children', 'permissions']));
    }

    public function update(UpdateModuleRequest $request, Module $module)
    {
        $module->update($request->validated());

        return response()->json($module->load('parent'));
    }

    public function destroy(Module $module)
    {
        // Delete all children first
        $module->children()->delete();

        $module->delete();

        return response()->json(['message' => 'Module deleted successfully']);
    }

    public function getTree()
    {
        $modules = Module::getTree();

        return response()->json($modules);
    }
}
