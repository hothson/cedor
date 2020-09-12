<?php

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
        $this->call(MemberSeeder::class);
        $this->call(MemberYogaSeeder::class);
        $this->call(MemberWalkingSeeder::class);
        $this->call(HealthIndexSeeder::class);
    }
}
