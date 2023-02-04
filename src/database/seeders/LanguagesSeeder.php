<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['language' => 'HTML'],
            ['language' => 'CSS'],
            ['language' => 'JavaScript'],
            ['language' => 'PHP'],
            ['language' => 'Laravel'],
            ['language' => 'Python'],
            ['language' => 'Golang'],
            ['language' => 'TypeScript'],
            // ['language' => 'C'],
            // ['language' => 'C++'],
            // ['language' => 'C#'],
            // ['language' => 'Java'],
            // ['language' => 'Rust'],
            // ['language' => 'Ruby'],
            // ['language' => 'R'],
            // ['language' => 'Scala'],
            // ['language' => 'Flutter'],
        ];
        Language::insert($items);
    }
}
