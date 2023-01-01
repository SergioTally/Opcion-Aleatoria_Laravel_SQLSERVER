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
        $empresas = Empresa::where('emp_id', '>', 0)->get();
        foreach ($empresas as $emp) {
            $user->Empresas()->attach($emp->emp_id);
        }
        $terminales = Terminal::where('ter_id', '>', 0)->get();
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(2);
        $user->assignRole(['Consulta']);
        $user->Empresas()->attach([1, 2, 3, 4, 5, 6, 7, 8]);
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(3);
        $user->assignRole(['Consulta']);
        $user->Empresas()->attach([1, 2, 3, 4, 5, 6, 7, 8]);
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(4);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([1, 9]);
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(5);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([2, 4, 10]);
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(6);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([3]);
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(7);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([5, 6]);
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(8);
        $user->assignRole(['Contador']);
        $user->Empresas()->attach([7, 8]);
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(9);
        $user->assignRole(['Operador']);
        $user->assignRole(['Facturación']);
        $user->Empresas()->attach([1, 2, 3, 4, 5, 6, 7, 8]);
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(10);
        $user->assignRole(['Auxiliar de Contabilidad']);
        $user->Empresas()->attach([1, 2, 3]);
        $user->Terminales()->attach([3]);

        $user = Usuario::find(11);
        $user->assignRole(['Auxiliar de Contabilidad']);
        $user->Empresas()->attach([1, 2, 3, 4, 5, 6, 7, 8]);
        $user->Terminales()->attach([1]);
        $user = Usuario::find(12);
        $user->assignRole(['Planillas']);
        $user->Empresas()->attach([7, 8]);
        $user->Terminales()->attach([1]);
        $user = Usuario::find(13);
        $user->assignRole(['Consulta']);
        $user->Empresas()->attach([1, 2, 3, 4, 5, 6, 7, 8]);
        foreach ($terminales as $ter) {
            $user->Terminales()->attach($ter->ter_id);
        }
        $user = Usuario::find(14);
        $user->assignRole(['Super Administrador']);
        $user->Empresas()->attach([1, 2, 3, 4, 5, 6, 7, 8]);

        $user = Usuario::find(15);
        $user->assignRole(['Facturación']);
        $user->Empresas()->attach([3]);
        $user->Terminales()->attach([1]);

        $user = Usuario::find(16);
        $user->assignRole(['Facturación']);
        $user->Empresas()->attach([1]);
        $user->Terminales()->attach([1]);

        $user = Usuario::find(17);
        $user->assignRole(['Facturación']);
        $user->Empresas()->attach([3]);
        $user->Terminales()->attach([1]);

        $user = Usuario::find(18);
        $user->assignRole(['Auxiliar de Facturación']);
        $user->Empresas()->attach([1]);
        $user->Terminales()->attach([1]);

        $user = Usuario::find(19);
        $user->assignRole(['Auxiliar de Contabilidad']);
        $user->Empresas()->attach([5]);
        $user->Terminales()->attach([3]);

        $user = Usuario::find(20);
        $user->assignRole(['Auxiliar de Contabilidad']);
        $user->Empresas()->attach([6]);
        $user->Terminales()->attach([4]);

        $user = Usuario::find(21);
        $user->assignRole(['Auxiliar de Contabilidad']);
        $user->Empresas()->attach([8]);
        $user->Terminales()->attach([4]);

        $user = Usuario::find(22);
        $user->assignRole(['Facturación']);
        $user->Empresas()->attach([1]);
        $user->Terminales()->attach([2]);

        $user = Usuario::find(23);
        $user->assignRole(['Facturación']);
        $user->Empresas()->attach([1]);
        $user->Terminales()->attach([2]);

        $user = Usuario::find(24);
        $user->assignRole(['Auxiliar de Contabilidad']);
        $user->Empresas()->attach([1]);
        $user->Terminales()->attach([1]);

        $user = Usuario::find(25);
        $user->assignRole(['Facturación']);
        $user->Empresas()->attach([1]);
        $user->Terminales()->attach([1]);
    }
}
