<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read JSON file
        $json = file_get_contents(database_path('data_seed/permission.json'));
        $data = json_decode($json, true);

        // Insert data into the database
        foreach ($data as $item) {
            if(DB::table('permissions')->where('id', $item['id'])->count() == 0){
               DB::table('permissions')->insert([
                   'id' => $item['id'],
                   'name' => $item['name'],
                   'guard_name' => $item['guard_name'],
               ]);
            }
        }
    }
}
