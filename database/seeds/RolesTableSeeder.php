<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Super usuario con todos los permisos.'
        ]);
        Role::create([
            'name' => 'moder',
            'display_name' => 'Moderador',
            'description' => 'Usuario con unos permisos.'
        ]);
        Role::create([
            'name' => 'student',
            'display_name' => 'Estudiante',
            'description' => 'Usuario con pocos permisos.'
        ]);
    }
}
