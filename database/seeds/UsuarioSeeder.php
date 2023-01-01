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
        ], [
            'usu_nombre' => 'nvasquez',
            'usu_pwd' => bcrypt('nvasquez'),
            'usu_activo' => 1,
            'usu_empleado' => 1,
        ], [
            'usu_nombre' => 'creyes',
            'usu_pwd' => bcrypt('creyes'),
            'usu_activo' => 1,
            'usu_empleado' => 2,
        ], [
            'usu_nombre' => 'wmolina',
            'usu_pwd' => bcrypt('wmolina'),
            'usu_activo' => 1,
            'usu_empleado' => 3,
        ], [
            'usu_nombre' => 'sgarcia',
            'usu_pwd' => bcrypt('sgarcia'),
            'usu_activo' => 1,
            'usu_empleado' => 4,
        ], [
            'usu_nombre' => 'abamaca',
            'usu_pwd' => bcrypt('abamaca'),
            'usu_activo' => 1,
            'usu_empleado' => 5,
        ], [
            'usu_nombre' => 'eyat',
            'usu_pwd' => bcrypt('eyat'),
            'usu_activo' => 1,
            'usu_empleado' => 6,
        ], [
            'usu_nombre' => 'ryat',
            'usu_pwd' => bcrypt('ryat'),
            'usu_activo' => 1,
            'usu_empleado' => 7,
        ], [
            'usu_nombre' => 'gecheverria',
            'usu_pwd' => bcrypt('gecheverria'),
            'usu_activo' => 1,
            'usu_empleado' => 8,
        ], [
            'usu_nombre' => 'zcallejas',
            'usu_pwd' => bcrypt('zcallejas'),
            'usu_activo' => 1,
            'usu_empleado' => 9,
        ], [
            'usu_nombre' => 'rurbina',
            'usu_pwd' => bcrypt('rurbina'),
            'usu_activo' => 1,
            'usu_empleado' => 10,
        ], [
            'usu_nombre' => 'ncalderon',
            'usu_pwd' => bcrypt('ncalderon'),
            'usu_activo' => 1,
            'usu_empleado' => 11,
        ], [
            'usu_nombre' => 'asamayoa',
            'usu_pwd' => bcrypt('asamayoa'),
            'usu_activo' => 1,
            'usu_empleado' => 12,
        ], [
            'usu_nombre' => 'juruzar',
            'usu_pwd' => bcrypt('jurizar'),
            'usu_activo' => 1,
            'usu_empleado' => 13,
        ], [//15
            'usu_nombre' => 'rbatista',
            'usu_pwd' => bcrypt('rbatista'),
            'usu_activo' => 1,
            'usu_empleado' => 0,
        ], [//16
            'usu_nombre' => 'obeltran',
            'usu_pwd' => bcrypt('obeltran'),
            'usu_activo' => 1,
            'usu_empleado' => 0,
        ], [//17
            'usu_nombre' => 'mmendoza',
            'usu_pwd' => bcrypt('mmendoza'),
            'usu_activo' => 1,
            'usu_empleado' => 0,
        ], [//18
            'usu_nombre' => 'rsalguero',
            'usu_pwd' => bcrypt('rsalguero'),
            'usu_activo' => 1,
            'usu_empleado' => 0,
        ], [//19
            'usu_nombre' => 'arubio',
            'usu_pwd' => bcrypt('arubio'),
            'usu_activo' => 1,
            'usu_empleado' => 0,
        ], [//20
            'usu_nombre' => 'erabanales',
            'usu_pwd' => bcrypt('erabanales'),
            'usu_activo' => 1,
            'usu_empleado' => 0,
        ], [//21
            'usu_nombre' => 'cbocanegra',
            'usu_pwd' => bcrypt('cbocanegra'),
            'usu_activo' => 1,
            'usu_empleado' => 0,
        ],
            [//22
                'usu_nombre' => 'amaldonado',
                'usu_pwd' => bcrypt('amaldonado'),
                'usu_activo' => 1,
                'usu_empleado' => 0,
            ],
            [//23
                'usu_nombre' => 'nmuñoz',
                'usu_pwd' => bcrypt('nmuñoz'),
                'usu_activo' => 1,
                'usu_empleado' => 0,
            ], [//24
                'usu_nombre' => 'amoran',
                'usu_pwd' => bcrypt('amoran'),
                'usu_activo' => 1,
                'usu_empleado' => 0,
            ],
            [//25
                'usu_nombre' => 'ebeltran',
                'usu_pwd' => bcrypt('ebeltran'),
                'usu_activo' => 1,
                'usu_empleado' => 0,
            ],

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
