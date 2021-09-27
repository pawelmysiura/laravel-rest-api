<?php

namespace Database\Seeders;

use App\Models\Blood;
use Illuminate\Database\Seeder;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'title' => 'Mocz - badanie ogólne',
                'code' => '1',
                'codeICD' => 'A01',
            ],
            [
                'id' => 2,
                'title' => 'Morfologia krwi',
                'code' => '3',
                'codeICD' => 'C55'
            ],
            [
                'id' => 3,
                'title' => 'PT (INR)',
                'code' => '6',
                'codeICD' => 'G21',
            ],
        ];

        $bloodToCategories = [
            1 => [1, 3],
            3 => [3]
        ];

        foreach ($data as $bloodData) {
            $blood = Blood::create($bloodData);

            $categories = $bloodToCategories[$bloodData['id']] ?? null;

            if ($categories !== null) {
                foreach ($categories as $categoryId) {
                    $blood->categories()->attach($categoryId);
                }
                $blood->save();
            }
        }
    }
}
