<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create(['name'=>'Super Administrador']);
        Role::create(['name'=>'Administrador']);

        $rol = Role::findByName('Administrador');
        $permisos = Permission::get();
        foreach ($permisos as $permiso) {
            $permiso->assignRole($rol);
        }
    }
}
