<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read JSON file
        $json = file_get_contents(database_path('data_seed/roleHasPermission.json'));
        $data = json_decode($json, true); 

        // Insert data into the database
        foreach ($data as $item) {
            if(DB::table('role_has_permissions')->where('permission_id', $item['permission_id'])->where('role_id', $item['role_id'])->count() == 0){
               DB::table('role_has_permissions')->insert([
                   'permission_id' => $item['permission_id'],
                   'role_id' => $item['role_id'],
               ]);
            }
        }
    }
}
