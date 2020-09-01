<?php

use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('members')->truncate();
        factory(App\Models\Member::class, 10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
