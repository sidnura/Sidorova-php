<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage' => ['all'], 
            'posts' => ['list', 'view', 'create', 'edit', 'delete'],
            'comments' => ['create', 'view', 'delete'],
            'users' => ['index', 'create', 'edit', 'update'] 
        ];

        foreach ($permissions as $group => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$group}.{$action}",
                    'guard_name' => 'web'
                ]);
            }
        }

        $roles = [
            'admin' => array_merge(
                Permission::all()->pluck('name')->toArray(),
                ['manage.all'] 
            ),
            
            'editor' => [
                'posts.create',
                'posts.edit',
                'posts.view', 
                'posts.list'
            ],
            
            'user' => [
                'posts.view',
                'posts.list',
                'comments.create',
                'comments.view'
            ]
        ];
    
        foreach ($roles as $roleName => $permissionNames) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
            
            $role->syncPermissions($permissionNames);
            $this->command->info("Роль {$roleName} создана с разрешениями: " . implode(', ', $permissionNames));
        }

        $this->assignRolesToUsers();
    }

    protected function assignRolesToUsers()
    {
        $users = [
            'anna@yandex.ru' => 'admin',
            'veronika@yandex.ru' => 'editor',
            'sasha@yandex.ru' => 'user',
            'natasha@yandex.ru' => 'user'
        ];
        
        foreach ($users as $email => $role) {
            if ($user = User::where('email', $email)->first()) {
                $user->syncRoles([$role]);
                $this->command->info("Роль {$role} назначена пользователю {$email}");
            } else {
                $this->command->error("Пользователь {$email} не найден!");
            }
        }

        $usersWithoutRoles = User::whereDoesntHave('roles')->get();
        
        foreach ($usersWithoutRoles as $user) {
            if (!in_array($user->email, array_keys($users))) {
                $user->assignRole('user'); 
                $this->command->info("Роль 'user' назначена пользователю {$user->email}");
            }
        }
    }

}