<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'numero_identificacao' => NULL,
            'tipo_documento' => NULL,
            'name' => 'Administrador',
            'username' => 1234567,
            'roleDB' => 'admin',
            'role' => 'Administrador',
            'unidade_organica' => 'ESTG',
            'password' => bcrypt('root'),
            'email' => 'admin@mail.pt',
            'blocked' => 0,
            'deleted_at' => NULL,
            'remember_token' => NULL,
        ]);
		DB::table('users')->insert([
            'numero_identificacao' => NULL,
            'tipo_documento' => NULL,
            'name' => 'Coordenador de Curso',
            'username' => 'codcur',
            'roleDB' => 'proponente_curso',
            'role' => 'proponente',
            'unidade_organica' => 'ESTG',
            'password' => bcrypt('root'),
            'email' => 'codcur@mail.pt',
            'blocked' => 0,
            'deleted_at' => NULL,
            'remember_token' => NULL,
        ]);
		DB::table('users')->insert([
            'numero_identificacao' => NULL,
            'tipo_documento' => NULL,
            'name' => 'Coordenador de Departamento',
            'username' => 'coddep',
            'roleDB' => 'proponente_departamento',
            'role' => 'proponente',
            'unidade_organica' => 'ESTG',
            'password' => bcrypt('root'),
            'email' => 'coddep@mail.pt',
            'blocked' => 0,
            'deleted_at' => NULL,
            'remember_token' => NULL,
        ]);
		DB::table('users')->insert([
            'numero_identificacao' => NULL,
            'tipo_documento' => NULL,
            'name' => 'Diretor da UO',
            'username' => 'diretor_uo',
            'roleDB' => 'diretor_uo',
            'role' => 'diretor_uo',
            'unidade_organica' => 'ESTG',
            'password' => bcrypt('root'),
            'email' => 'diretor_uo@mail.pt',
            'blocked' => 0,
            'deleted_at' => NULL,
            'remember_token' => NULL,
        ]);
		DB::table('users')->insert([
            'numero_identificacao' => NULL,
            'tipo_documento' => NULL,
            'name' => 'CTC',
            'username' => 'ctc',
            'roleDB' => 'ctc',
            'role' => 'ctc',
            'unidade_organica' => 'ESTG',
            'password' => bcrypt('root'),
            'email' => 'ctc@mail.pt',
            'blocked' => 0,
            'deleted_at' => NULL,
            'remember_token' => NULL,
        ]);
		DB::table('users')->insert([
            'numero_identificacao' => NULL,
            'tipo_documento' => NULL,
            'name' => 'Secretariado da Direção',
            'username' => 'secretariado_direcao',
            'roleDB' => 'secretariado_direcao',
            'role' => 'secretariado_direcao',
            'unidade_organica' => 'ESTG',
            'password' => bcrypt('root'),
            'email' => 'secretariado_direcao@mail.pt',
            'blocked' => 0,
            'deleted_at' => NULL,
            'remember_token' => NULL,
        ]);
        DB::table('users')->insert([
            'numero_identificacao' => NULL,
            'tipo_documento' => NULL,
            'name' => 'Recursos Humanos',
            'username' => 'recursos_humanos',
            'roleDB' => 'recursos_humanos',
            'role' => 'recursos_humanos',
            'unidade_organica' => 'ESTG',
            'password' => bcrypt('root'),
            'email' => 'recursos_humanos@mail.pt',
            'blocked' => 0,
            'deleted_at' => NULL,
            'remember_token' => NULL,
        ]);
		DB::table('users')->insert([
            'numero_identificacao' => NULL,
            'tipo_documento' => NULL,
            'name' => 'Docente Temporário',
            'username' => 'docente_temp',
            'roleDB' => 'docente_temp',
            'role' => 'docente_temp',
            'unidade_organica' => 'ESTG',
            'password' => bcrypt('root'),
            'email' => 'docente_temp@mail.pt',
            'blocked' => 0,
            'deleted_at' => NULL,
            'remember_token' => NULL,
        ]);
    }
}
