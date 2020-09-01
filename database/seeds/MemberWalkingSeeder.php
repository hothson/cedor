<?php

use Illuminate\Database\Seeder;

class MemberWalkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('member_walking')->truncate();

        DB::table('walking_classes')->truncate();
        factory(App\Models\WalkingClass::class, 10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $walkingClasses = App\Models\WalkingClass::all();

        App\Models\Member::all()->each(function ($member) use ($walkingClasses) {

            $member->walkingClasses()->attach(
                $walkingClasses->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
