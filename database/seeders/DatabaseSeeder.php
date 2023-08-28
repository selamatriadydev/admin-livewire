<?php

namespace Database\Seeders;

use App\Http\Livewire\Settings\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            ModulesSeeder::class,
            PermissionSeeder::class,
            RoleHasModuleSeeder::class,
            RoleHasPermissionSeeder::class,
        ]);
    }
}
