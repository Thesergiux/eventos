<?php

namespace Database\Seeders;

use App\Models\Permission;
use DB;

class DashboardTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate(['dashboard_sections', 'dashboard_submenus', 'dashboard_links']);

        $permissions = Permission::all('id', 'key_name')->pluck('id', 'key_name');

        foreach ($this->getData() as $i => $section) {
            $sectionId = DB::table('dashboard_sections')->insertGetId([
                'name'       => $section['name'],
                'tile'       => $section['tile'],
                'order'      => $i + 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            foreach ($section['submenus'] as $j => $submenu) {
                $submenuId = DB::table('dashboard_submenus')->insertGetId([
                    'name'       => $submenu['name'],
                    'icon'       => $submenu['icon'],
                    'order'      => $j + 1,
                    'section_id' => $sectionId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                foreach ($submenu['links'] as $k => $link) {
                    DB::table('dashboard_links')->insert([
                        'name'          => $link['name'],
                        'route'         => $link['route'],
                        'order'         => $k + 1,
                        'submenu_id'    => $submenuId,
                        'permission_id' => $permissions[$link['permission']],
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }



    /**
     * Return the data to populate tables.
     *
     * @return array
     */
    private function getData()
    {
        return [
            [
                'name' => 'ACL',
                'tile' => 'lock.svg',
                'submenus' => [
                    [
                        'name' => 'Permisos',
                        'icon' => 'permissions.svg',
                        'links' => [
                            [
                                'name'       => 'Agregar permisos',
                                'route'      => 'agregar-permisos',
                                'permission' => 'create.permissions'
                            ],
                            [
                                'name'       => 'Lista de permisos',
                                'route'      => 'permisos',
                                'permission' => 'view.permissions'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Roles',
                        'icon' => 'role.svg',
                        'links' => [
                            [
                                'name'       => 'Agregar roles',
                                'route'      => 'agregar-roles',
                                'permission' => 'create.roles'
                            ],
                            [
                                'name'       => 'Lista de roles',
                                'route'      => 'roles',
                                'permission' => 'view.roles'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Usuarios',
                        'icon' => 'users.svg',
                        'links' => [
                            [
                                'name'       => 'Lista de usuarios',
                                'route'      => 'usuarios',
                                'permission' => 'view.users'
                            ]
                        ],
                    ],
                    
                ]
            ],
            [
                'name' => 'Eventos',
                'tile' => 'events.svg',
                'submenus' => [
                    [
                        'name' => 'Eventos',
                        'icon' => 'events.svg',
                        'links' => [
                            [
                                'name'       => 'Agregar eventos',
                                'route'      => 'agregar-evento',
                                'permission' => 'create.events'
                            ],
                            [
                                'name'       => 'Lista de eventos',
                                'route'      => 'eventos',
                                'permission' => 'view.events'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Proyectos',
                'tile' => 'projects.svg',
                'submenus' => [
                    [
                        'name' => 'Proyectos',
                        'icon' => 'projects.svg',
                        'links' => [
                            [
                                'name'       => 'Agregar proyecto',
                                'route'      => 'agregar-proyecto',
                                'permission' => 'create.projects'
                            ],
                            [
                                'name'       => 'Lista de proyectos',
                                'route'      => 'proyectos',
                                'permission' => 'view.projects'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Equipos',
                        'icon' => 'teams.svg',
                        'links' => [
                            [
                                'name'       => 'Agregar equipos',
                                'route'      => 'agregar-equipos',
                                'permission' => 'create.teams'
                            ],
                            [
                                'name'       => 'Lista de equipos',
                                'route'      => 'equipos',
                                'permission' => 'view.teams'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Participantes',
                        'icon' => 'participants.svg',
                        'links' => [
                            [
                                'name'       => 'Agregar participantes',
                                'route'      => 'agregar-participante',
                                'permission' => 'create.participants'
                            ],
                            [
                                'name'       => 'Lista de participantes',
                                'route'      => 'participantes',
                                'permission' => 'view.participants'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Rubricas',
                'tile' => 'rubrics.svg',
                'submenus' => [
                    [
                        'name' => 'Rubricas',
                        'icon' => 'rubrics.svg',
                        'links' => [
                            [
                                'name'       => 'Agregar rubrica',
                                'route'      => 'agregar-rubrica',
                                'permission' => 'create.rubrics'
                            ],
                            [
                                'name'       => 'Lista de rubricas',
                                'route'      => 'rubricas',
                                'permission' => 'view.rubrics'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Criterios',
                        'icon' => 'criterias.svg',
                        'links' => [
                            [
                                'name'       => 'Agregar criterio',
                                'route'      => 'agregar-criterio',
                                'permission' => 'create.criterias'
                            ],
                            [
                                'name'       => 'Lista de criterios',
                                'route'      => 'criterios',
                                'permission' => 'view.criterias'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Indicadores',
                'tile' => 'indicadores.svg',
                'submenus' => [
                    [
                        'name' => 'Estadísticas',
                        'icon' => 'estadisticas.svg',
                        'links' => [
                            [
                                'name'       => 'Estadísticas de evento',
                                'route'      => 'estadisticas-evento',
                                'permission' => 'view.statistics'
                            ],
                            
                        ]
                    ],
                ]
            ],
            
        ];
    }
}

