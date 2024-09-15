<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crear Usuario Inicial como Super Administrador
        $user = User::create([
            'name' => 'Ronny Gutierrez',
            'username' => 'rgutierrez',
            'email' => 'rgutierrez@cotecmar.com',
            'password' => bcrypt('0'),
            'guid' => '82b3de25-2e73-4c2d-96bc-47162a1d9626',
        ]);

        $user1 = User::create([
            'name' => 'name',
            'username' => 'dibarra',
            'email' => 'dibarra@cotecmar.com',
            'password' => 0,
            'guid' => '5c3648ad-a593-414e-82eb-4597a4dd7dd5',
        ]);

        $superAdminUser = Role::create(['guard_name' => 'sanctum', 'name' => 'Super-Admin']);
        $userAdmin = Role::create(['guard_name' => 'sanctum', 'name' => 'Administrador']);

        // $permissions = PermissionTableSeeder::class;

        $permissions = [
            'reuniones.lista.index' => 'ver_lista_de_reuniones',
        ];

        foreach ($permissions as $permission) {

            Permission::create(['guard_name' => 'sanctum', 'name' => $permission]);
        }

        $superAdminUser->givePermissionTo(Permission::all());
        $userAdmin->givePermissionTo(Permission::all());

        $user->assignRole('Super-Admin');
        $user1->assignRole('Super-Admin');
    }
}
