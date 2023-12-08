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
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,

            'tel' => $this->faker->phoneNumber,
            'date_birth' => $this->faker->date($format = 'D-m-y', $max = '2003', $min = '1970'),

            'num_ifu' => $this->faker->unique()->randomNumber(13),
            'prenom' => $this->faker->firstName,
            'profess' => $thisfaker->jobTitle(),
            'tel' => $this->faker->phoneNumber,
            'banque' => $this->faker->randomElement($banques),
            'num_compt' => $this->faker->bankAccountNumber,
            'type_prs' => $this->faker->randomElement(['personne_physique', 'personne_morale']),
            'nationalite' => $this->faker->country,
            'boite' => $this->faker-postcode(),
            'adresse' => $this->faker->address,
            'nomsociete' => $this->faker->company,
            'email' => $this->faker->email,
            'categorie' =>$this->faker->randomElement(['importatrice', 'exportatrice', 'autre']),

        ];
    }
}
