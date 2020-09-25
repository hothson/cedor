<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Member;

class WalkingAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('walking_attendance')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $walkingIds = App\Models\WalkingClass::all()->pluck('id')->toArray();
        $userIds = Member::all()->pluck('id')->toArray();

        foreach ($userIds as $key => $userId) {
            foreach ($walkingIds as $key => $walkingId) {
                DB::table('walking_attendance')->insert([
                    'member_id' => $userId,
                    'walking_id' => $walkingId,
                    'attendance' => '2020-09-25',
                    'vitaminD' => '800',
                ]);
            }
        }
    }
}
