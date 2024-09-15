<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'ver_lista_usuarios_admin',
            //TODO: Lista de Permisos
        ];

        //Run: php artisan db:seed --class=PermissionTableSeeder
        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'sanctum', 'name' => $permission]);
        }
    }
}
