<?php

namespace ModulePosyandu\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->call('module:migrate', ['module' => 'Posyandu']);

        $this->call(PosyanduBaseSeeder::class);
        $this->call(PosyanduDataSeeder::class);
        $this->call(PosyanduUserSeeder::class);
    }
}
