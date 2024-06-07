<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gun;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Storage::json('categories.json');

        Category::upsert($categories, 'id', ['name']);

        $guns = Storage::json('guns.json');

        Gun::upsert($guns, 'id', ['name']);
    }
}
