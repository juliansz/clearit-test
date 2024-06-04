<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'capacity' => rand(1, 20),
            'period_in_hours' => 1,
        ];
    }

    public function classroomA()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Classroom A',
                'capacity' => 10,
                'period_in_hours' => 1,
            ];
        });
    }

    public function classroomB()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Classroom B',
                'capacity' => 15,
                'period_in_hours' => 2,
            ];
        });
    }

    public function classroomC()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Classroom C',
                'capacity' => 7,
                'period_in_hours' => 1,
            ];
        });
    }
}
