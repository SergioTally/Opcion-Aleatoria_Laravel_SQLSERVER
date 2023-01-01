<?php

use App\Models\Parametros\Empresa;
use App\Models\Parametros\Terminal;
use App\Models\Seguridad\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuario')->insert([[
            'usu_nombre' => 'sa',
            'usu_pwd' => bcrypt('sa'),
            'usu_activo' => 1,
            'usu_empleado' => 0,
        ]
        ]);
        $user = Usuario::find(1);
        $user->assignRole(['Super Administrador']);
    }
}
