<?php
namespace Database\Seeders;

use DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate(['permissions']);

        foreach ($this->getData() as $keyName => $name) {
            DB::table('permissions')->insert([
                'key_name'   => $keyName,
                'name'       => $name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }


    /**
     * Return the data to populate table.
     *
     * @return array
     */
    private function getData()
    {
        return [
             /*
             * Profile
             */
            'update.password' => 'Cambiar contraseña',
            'update.profile'  => 'Cambiar Perfil',

            /*
             * eventos
             */
            'view.events'   => 'Ver eventos',
            'create.events' => 'Agregar eventos',
            'edit.events'   => 'Editar eventos',
            'delete.events' => 'Eliminar eventos',

            /*
             * proyectos
             */
            'view.projects'   => 'Ver proyectos',
            'create.projects' => 'Agregar proyectos',
            'edit.projects'   => 'Editar proyectos',
            'delete.projects' => 'Eliminar proyectos',

            /*
             * equipos
             */
            'view.teams'   => 'Ver equipos',
            'create.teams' => 'Crear equipos',
            'edit.teams'   => 'Editar equipos',
            'delete.teams' => 'Eliminar equipos',

            /*
             * permission
             */
            'view.permissions'   => 'Ver permisos',
            'create.permissions' => 'Agregar permisos',
            'edit.permissions'   => 'Editar permisos',
            'delete.permissions' => 'Eliminar permisos',

            /*
             * roles
             */
            'view.roles'   => 'Ver roles',
            'create.roles' => 'Agregar roles',
            'edit.roles'   => 'Editar roles',
            'delete.roles' => 'Eliminar roles',

            /*
             * participantes
             */
            'view.participants'   => 'Ver participantes',
            'create.participants' => 'Agregar participantes',
            'edit.participants'   => 'Editar participantes',
            'delete.participants' => 'Eliminar participantes',

            /*
             * evaluaciones
             */
            'view.evaluations'   => 'Ver evaluaciones',
            'create.evaluations' => 'Agregar evaluaciones',
            'edit.evaluations'   => 'Editar evaluaciones',
            'delete.evaluations' => 'Eliminar evaluaciones',

            /*
             * Rubricas
             */
            'view.rubrics'   => 'Ver rubricas',
            'create.rubrics' => 'Agregar rubricas',
            'edit.rubrics'   => 'Editar rubricas',
            'delete.rubrics' => 'Eliminar rubricas',

            /*
             * criterios
             */
            'view.criterias'   => 'Ver criterios',
            'create.criterias' => 'Agregar criterios',
            'edit.criterias'   => 'Editar criterios',
            'delete.criterias' => 'Eliminar criterios',

            /*
             * Users
             */
            'view.users'   => 'Ver Usuarios',
            'create.users' => 'Agregar usuarios',

            /*
             * Statistics
             */
            'view.statistics'   => 'Ver estadísticas',
            
        ];
    }
}
