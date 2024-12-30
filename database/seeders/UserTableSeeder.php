<?php

namespace Database\Seeders;

use DB;
use Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate(['users']);

        foreach ($this->getData() as $keyName => $data) {
            DB::table('users')->insert([
                'username'   => $keyName,
                'name'       => $data['name'],
                'last_name'  => $data['last_name'],
                'email'      => $data['email'],
                'password'   => Hash::make($data['password']),
                'role_id'    => $data['role'],
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
             * user
             */
            'arturo.morales' => [
                'name'       => 'Arturo',
                'last_name'  => 'Morales',
                'email'      => 'ramon.morales41@gmail.com',
                'password'   => '12345678',
                'role'       => 1
            ],
        ];
    }
}
