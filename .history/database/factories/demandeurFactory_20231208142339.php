<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\demandeur>
 */
class demandeurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name,
            'prenom' => $this->faker->firstname,

            'email' => $this->faker->email,
            'tel' => $this->faker->phoneNumber,
            'date_birth' => $this->faker->date($format = 'D-m-y', $max = '2000', $min = '1990')
        ];
    }
}
