<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Member;

class HealthIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('health_indexes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $userIds = Member::all()->pluck('id')->toArray();
        foreach ($userIds as $key => $userId) {
            for ($i = 0; $i < 10; $i++) {
                DB::table('health_indexes')->insert([
                    'member_id' => $userId,
                    'weight' => $faker->randomNumber(2),
                    'body_fat' => $faker->randomNumber(2),
                    'belly_fat' => $faker->randomNumber(2),
                    'subcutaneous_fate' => $faker->randomNumber(2),
                    'colon_fat' => $faker->randomNumber(2),
                    'bone_muscle_mass' => $faker->randomNumber(2),
                    'vitamin_D' => $faker->randomNumber(3),
                    'date' => $faker->unique()->date('Y-m-d'),
                    'time' => $i + 1,
                ]);
            }
        }
    }
}
