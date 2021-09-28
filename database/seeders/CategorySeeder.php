<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'title' => 'Alergologia',
            ],
            [
                'id' => 2,
                'title' => 'Anemia',
            ],
            [
                'id' => 3,
                'title' => 'Celiakia',
            ],
        ];

        foreach ($data as $category) {
            Category::create($category);
        }
    }
}
