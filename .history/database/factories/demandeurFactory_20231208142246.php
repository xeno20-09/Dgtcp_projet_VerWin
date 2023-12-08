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
            'name' => $this<faker->name,
            'email' => $faker->email,
            'phone_number' => $faker->phoneNumber,
            'dob' => $faker->date($format = 'D-m-y', $max = '2000',$min = '1990')
        ];
    }
}
