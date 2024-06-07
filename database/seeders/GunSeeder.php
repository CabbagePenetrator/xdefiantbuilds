<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gun;
use Illuminate\Database\Seeder;

class GunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->createMany([
            [
                'id' => 1,
                'name' => 'assault',
            ],
            [
                'id' => 2,
                'name' => 'SMG',
            ],
            [
                'id' => 3,
                'name' => 'shotgun',
            ],
            [
                'id' => 4,
                'name' => 'LMG',
            ],
            [
                'id' => 5,
                'name' => 'Marksman',
            ],
            [
                'id' => 6,
                'name' => 'sniper',
            ],
        ]);

        Gun::factory()->createMany([
            [
                'name' => 'MP7',
                'category_id' => 2,
            ],
        ]);
    }
}
