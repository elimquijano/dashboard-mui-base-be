<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        $modules = [
            // Dashboard Module
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'description' => 'Dashboard principal del sistema',
                'icon' => 'DashboardIcon',
                'sort_order' => 1,
                'type' => 'module',
                'status' => 'active',
                'children' => [
                    [
                        'name' => 'Default',
                        'slug' => 'dashboard.default',
                        'description' => 'Dashboard por defecto',
                        'icon' => 'DashboardIcon',
                        'sort_order' => 1,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Analytics',
                        'slug' => 'dashboard.analytics',
                        'description' => 'Dashboard de analíticas',
                        'icon' => 'BarChartIcon',
                        'sort_order' => 2,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                ]
            ],
            // Widget Module
            [
                'name' => 'Widget',
                'slug' => 'widget',
                'description' => 'Módulo de widgets',
                'icon' => 'WidgetsIcon',
                'sort_order' => 2,
                'type' => 'module',
                'status' => 'active',
                'children' => [
                    [
                        'name' => 'Statistics',
                        'slug' => 'widget.statistics',
                        'description' => 'Widget de estadísticas',
                        'icon' => 'TrendingUpIcon',
                        'sort_order' => 1,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Data',
                        'slug' => 'widget.data',
                        'description' => 'Widget de datos',
                        'icon' => 'StorageIcon',
                        'sort_order' => 2,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Chart',
                        'slug' => 'widget.chart',
                        'description' => 'Widget de gráficos',
                        'icon' => 'PieChartIcon',
                        'sort_order' => 3,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                ]
            ],
            // Application Module
            [
                'name' => 'Application',
                'slug' => 'application',
                'description' => 'Módulo de aplicaciones',
                'icon' => 'AppsIcon',
                'sort_order' => 3,
                'type' => 'module',
                'status' => 'active',
                'children' => [
                    [
                        'name' => 'Users',
                        'slug' => 'users',
                        'description' => 'Gestión de usuarios',
                        'icon' => 'PeopleIcon',
                        'sort_order' => 1,
                        'type' => 'group',
                        'status' => 'active',
                        'children' => [
                            [
                                'name' => 'User List',
                                'slug' => 'users.list',
                                'description' => 'Lista de usuarios',
                                'icon' => 'PeopleIcon',
                                'sort_order' => 1,
                                'type' => 'page',
                                'status' => 'active',
                            ],
                            [
                                'name' => 'User Roles',
                                'slug' => 'users.roles',
                                'description' => 'Roles de usuarios',
                                'icon' => 'SecurityIcon',
                                'sort_order' => 2,
                                'type' => 'page',
                                'status' => 'active',
                            ],
                            [
                                'name' => 'Permissions',
                                'slug' => 'users.permissions',
                                'description' => 'Permisos de usuarios',
                                'icon' => 'VpnKeyIcon',
                                'sort_order' => 3,
                                'type' => 'page',
                                'status' => 'active',
                            ],
                        ]
                    ],
                    [
                        'name' => 'Customer',
                        'slug' => 'customers',
                        'description' => 'Gestión de clientes',
                        'icon' => 'GroupIcon',
                        'sort_order' => 2,
                        'type' => 'group',
                        'status' => 'active',
                        'children' => [
                            [
                                'name' => 'Customer List',
                                'slug' => 'customers.list',
                                'description' => 'Lista de clientes',
                                'icon' => 'GroupIcon',
                                'sort_order' => 1,
                                'type' => 'page',
                                'status' => 'active',
                            ],
                            [
                                'name' => 'Customer Details',
                                'slug' => 'customers.details',
                                'description' => 'Detalles de clientes',
                                'icon' => 'PersonIcon',
                                'sort_order' => 2,
                                'type' => 'page',
                                'status' => 'active',
                            ],
                        ]
                    ],
                    [
                        'name' => 'Chat',
                        'slug' => 'chat',
                        'description' => 'Sistema de chat',
                        'icon' => 'ChatIcon',
                        'sort_order' => 3,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Kanban',
                        'slug' => 'kanban',
                        'description' => 'Tablero Kanban',
                        'icon' => 'ViewKanbanIcon',
                        'sort_order' => 4,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Mail',
                        'slug' => 'mail',
                        'description' => 'Sistema de correo',
                        'icon' => 'MailIcon',
                        'sort_order' => 5,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Calendar',
                        'slug' => 'calendar',
                        'description' => 'Calendario',
                        'icon' => 'CalendarTodayIcon',
                        'sort_order' => 6,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                ]
            ],
            // System Module
            [
                'name' => 'System',
                'slug' => 'system',
                'description' => 'Configuración del sistema',
                'icon' => 'SettingsIcon',
                'sort_order' => 4,
                'type' => 'module',
                'status' => 'active',
                'children' => [
                    [
                        'name' => 'Modules',
                        'slug' => 'system.modules',
                        'description' => 'Gestión de módulos',
                        'icon' => 'ArticleIcon',
                        'sort_order' => 1,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                    [
                        'name' => 'Settings',
                        'slug' => 'system.settings',
                        'description' => 'Configuraciones generales',
                        'icon' => 'SettingsIcon',
                        'sort_order' => 2,
                        'type' => 'page',
                        'status' => 'active',
                    ],
                ]
            ],
        ];

        $this->createModules($modules);
    }

    private function createModules($modules, $parentId = null)
    {
        foreach ($modules as $moduleData) {
            $children = $moduleData['children'] ?? [];
            unset($moduleData['children']);

            $moduleData['parent_id'] = $parentId;
            $module = Module::create($moduleData);

            if (!empty($children)) {
                $this->createModules($children, $module->id);
            }
        }
    }
}
