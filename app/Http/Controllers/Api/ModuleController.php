<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ModuleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Module::with(['parent', 'children'])
            ->withCount(['permissions']);

        // Filtros
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->has('type')) {
            $query->where('type', $request->get('type'));
        }

        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->has('parent_id')) {
            $query->where('parent_id', $request->get('parent_id'));
        }

        $modules = $query->orderBy('sort_order')->get();

        return response()->json([
            'success' => true,
            'data' => $modules
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:modules',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'parent_id' => 'nullable|exists:modules,id',
            'type' => 'required|in:module,group,page,button',
            'status' => 'required|in:active,inactive',
        ]);

        $module = Module::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $module->load(['parent', 'children']),
            'message' => 'Module created successfully'
        ], 201);
    }

    public function show(Module $module): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $module->load(['parent', 'children', 'permissions'])
        ]);
    }

    public function update(Request $request, Module $module): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:modules,slug,' . $module->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'parent_id' => 'nullable|exists:modules,id',
            'type' => 'required|in:module,group,page,button',
            'status' => 'required|in:active,inactive',
        ]);

        $module->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $module->load(['parent', 'children']),
            'message' => 'Module updated successfully'
        ]);
    }

    public function destroy(Module $module): JsonResponse
    {
        // Verificar si tiene hijos
        if ($module->children()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete module with children'
            ], 422);
        }

        $module->delete();

        return response()->json([
            'success' => true,
            'message' => 'Module deleted successfully'
        ]);
    }

    public function tree(): JsonResponse
    {
        $modules = Module::getTree();

        return response()->json([
            'success' => true,
            'data' => $modules
        ]);
    }

    public function menu(Request $request): JsonResponse
    {
        $user = $request->user();

        // Obtener módulos activos con sus permisos
        $modules = Module::with(['children.children.children'])
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        // Filtrar módulos basado en permisos del usuario
        $filteredModules = $this->filterModulesByPermissions($modules, $user);

        return response()->json([
            'success' => true,
            'data' => $filteredModules
        ]);
    }

    private function filterModulesByPermissions($modules, $user)
    {
        return $modules->filter(function ($module) use ($user) {
            // Si el módulo tiene un permiso específico, verificarlo
            $permission = $this->getModulePermission($module);

            if ($permission && !$user->can($permission)) {
                return false;
            }

            // Filtrar hijos recursivamente
            if ($module->children) {
                $filteredChildren = $this->filterModulesByPermissions($module->children, $user);
                $module->setRelation('children', $filteredChildren);

                // Si no tiene hijos visibles y es un grupo, ocultarlo
                if ($module->type === 'group' && $filteredChildren->isEmpty()) {
                    return false;
                }
            }

            return true;
        })->values();
    }

    private function getModulePermission($module)
    {
        // Mapear slugs de módulos a permisos
        $permissionMap = [
            'dashboard.default' => 'dashboard.view',
            'dashboard.analytics' => 'dashboard.analytics',
            'widget.statistics' => 'widget.statistics',
            'widget.data' => 'widget.data',
            'widget.chart' => 'widget.chart',
            'users.list' => 'users.view',
            'users.roles' => 'users.roles',
            'users.permissions' => 'users.permissions',
            'customers.list' => 'customers.view',
            'customers.details' => 'customers.details',
            'chat' => 'chat.view',
            'kanban' => 'kanban.view',
            'mail' => 'mail.view',
            'calendar' => 'calendar.view',
            'system.modules' => 'system.modules',
            'system.settings' => 'system.settings',
        ];

        return $permissionMap[$module->slug] ?? null;
    }
}
