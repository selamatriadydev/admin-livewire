<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read JSON file
        $json = file_get_contents(database_path('data_seed/roleHasModule.json'));
        $data = json_decode($json, true); 

        // Insert data into the database
        foreach ($data as $item) {
            if(DB::table('role_has_module')->where('role_id', $item['role_id'])->where('module_id', $item['module_id'])->count() == 0){
               DB::table('role_has_module')->insert([
                   'role_id' => $item['role_id'],
                   'module_id' => $item['module_id'],
               ]);
            }
        }
    }
}
