<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\LearningContent;
use App\Models\LearningTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $learning_contents = LearningContent::all();
        $contents_length = count($learning_contents);
        $languages = Language::all();
        $languages_length = count($languages);

        LearningTime::factory()->count(10)->create()
            ->each(function (LearningTime $learning_time) use (
                $learning_contents,
                $contents_length,
                $languages,
                $languages_length
            ) {
                $rand = rand(1, $languages_length);
                $learning_time->languages()->attach(
                    $languages->random($rand)->pluck('id')->toArray(),
                );

                $rand = rand(1, $contents_length);
                $learning_time->learning_contents()->attach(
                    $learning_contents->random($rand)->pluck('id')->toArray(),
                );
            });
    }
}
