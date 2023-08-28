<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            if(User::where('email', $item['email'])->count() == 0){
                User::create([
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
