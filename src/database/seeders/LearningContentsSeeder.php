<?php

namespace Database\Seeders;

use App\Models\LearningContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'N予備校'],
            ['name' => 'ドットインストール'],
            ['name' => 'POSSE課題'],
            ['name' => "O'reily"],
        ];
        LearningContent::insert($items);
    }
}
