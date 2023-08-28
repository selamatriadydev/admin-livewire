<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read JSON file
        $json = file_get_contents(database_path('data_seed/module.json'));
        $data = json_decode($json, true);

        // Insert data into the database
        foreach ($data as $item) {
            if(DB::table('modules')->where('id', $item['id'])->count() == 0){
               DB::table('modules')->insert([
                   'id' => $item['id'],
                   'parrent_id' => $item['parrent_id'],
                   'icon' => $item['icon'],
                   'is_sidebar' => $item['is_sidebar'],
                   'title' => $item['title'],
                   'url' => $item['url'],
                   'method' => $item['method'],
                   'slug' => $item['slug'],
                   'child' => $item['child'],
                   'sort' => $item['sort'],
               ]);
            }
        }
    }
}
