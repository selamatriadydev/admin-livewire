<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Read JSON file
        $json = file_get_contents(database_path('data_seed/user.json'));
        $data = json_decode($json, true);

        // Insert data into the database
        foreach ($data as $item) {
            if(DB::table('users')->where('email', $item['email'])->count() == 0){
                DB::table('users')->insert([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'email' => $item['email'],
                    'password' => bcrypt('password'),
                    'role_id' => $item['role_id'],
                    'status_active' => $item['status_active'],
                ]);
            }
        }
    }
}
