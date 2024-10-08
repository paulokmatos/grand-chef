<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Books',
        ]);

        Category::create([
            'name' => 'Music',
        ]);

        Category::create([
            'name' => 'Movies',
        ]);
    }
}
