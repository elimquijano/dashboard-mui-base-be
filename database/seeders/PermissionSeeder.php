<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Dashboard Module
            [
                'name' => 'dashboard.view',
                'display_name' => 'View Dashboard',
                'module' => 'Dashboard',
                'type' => 'view',
                'description' => 'Access to main dashboard',
            ],
            [
                'name' => 'dashboard.analytics',
                'display_name' => 'View Analytics',
                'module' => 'Dashboard',
                'type' => 'view',
                'description' => 'Access to analytics dashboard',
            ],

            // Widget Module
            [
                'name' => 'widget.statistics',
                'display_name' => 'View Statistics',
                'module' => 'Widget',
                'type' => 'view',
                'description' => 'Access to statistics widgets',
            ],
            [
                'name' => 'widget.data',
                'display_name' => 'View Data',
                'module' => 'Widget',
                'type' => 'view',
                'description' => 'Access to data widgets',
            ],
            [
                'name' => 'widget.chart',
                'display_name' => 'View Charts',
                'module' => 'Widget',
                'type' => 'view',
                'description' => 'Access to chart widgets',
            ],

            // Users Module
            [
                'name' => 'users.view',
                'display_name' => 'View Users',
                'module' => 'Users',
                'type' => 'view',
                'description' => 'View user list and details',
            ],
            [
                'name' => 'users.create',
                'display_name' => 'Create Users',
                'module' => 'Users',
                'type' => 'create',
                'description' => 'Create new users',
            ],
            [
                'name' => 'users.edit',
                'display_name' => 'Edit Users',
                'module' => 'Users',
                'type' => 'edit',
                'description' => 'Edit existing users',
            ],
            [
                'name' => 'users.delete',
                'display_name' => 'Delete Users',
                'module' => 'Users',
                'type' => 'delete',
                'description' => 'Delete users',
            ],
            [
                'name' => 'users.roles',
                'display_name' => 'Manage User Roles',
                'module' => 'Users',
                'type' => 'manage',
                'description' => 'Manage user roles',
            ],
            [
                'name' => 'users.permissions',
                'display_name' => 'Manage User Permissions',
                'module' => 'Users',
                'type' => 'manage',
                'description' => 'Manage user permissions',
            ],

            // Application Module
            [
                'name' => 'customers.view',
                'display_name' => 'View Customers',
                'module' => 'Application',
                'type' => 'view',
                'description' => 'View customer list',
            ],
            [
                'name' => 'customers.details',
                'display_name' => 'View Customer Details',
                'module' => 'Application',
                'type' => 'view',
                'description' => 'View customer details',
            ],
            [
                'name' => 'chat.view',
                'display_name' => 'Access Chat',
                'module' => 'Application',
                'type' => 'view',
                'description' => 'Access chat functionality',
            ],
            [
                'name' => 'kanban.view',
                'display_name' => 'Access Kanban',
                'module' => 'Application',
                'type' => 'view',
                'description' => 'Access kanban board',
            ],
            [
                'name' => 'mail.view',
                'display_name' => 'Access Mail',
                'module' => 'Application',
                'type' => 'view',
                'description' => 'Access mail functionality',
            ],
            [
                'name' => 'calendar.view',
                'display_name' => 'Access Calendar',
                'module' => 'Application',
                'type' => 'view',
                'description' => 'Access calendar functionality',
            ],

            // System Module
            [
                'name' => 'system.settings',
                'display_name' => 'System Settings',
                'module' => 'System',
                'type' => 'manage',
                'description' => 'Access system settings',
            ],
            [
                'name' => 'system.logs',
                'display_name' => 'System Logs',
                'module' => 'System',
                'type' => 'view',
                'description' => 'View system logs',
            ],
            [
                'name' => 'system.backup',
                'display_name' => 'System Backup',
                'module' => 'System',
                'type' => 'manage',
                'description' => 'Manage system backups',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }
    }
}
