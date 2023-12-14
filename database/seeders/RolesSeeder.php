<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crear rol y permiso
        $role = Role::create(['name' => 'Administrador2']);
        $permission = Permission::create(['name' => 'Venta2']);
        
        $permission->syncRoles($role);

        $user = User::find(1);

        $user->assignRole($role);
    }
}
