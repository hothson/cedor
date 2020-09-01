<?php

use Illuminate\Database\Seeder;

class MemberYogaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('member_yoga')->truncate();

        DB::table('yoga_classes')->truncate();
        factory(App\Models\YogaClass::class, 10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $yogaClasses = App\Models\YogaClass::all();

        App\Models\Member::all()->each(function ($member) use ($yogaClasses) {

            $member->yogaClasses()->attach(
                $yogaClasses->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
