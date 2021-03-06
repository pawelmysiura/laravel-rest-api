<?php

namespace Database\Factories;

use App\Models\Blood;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blood::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'code' => $this->faker->unique()->text(),
            'codeICD' => $this->faker->unique()->text(),
        ];
    }
}
