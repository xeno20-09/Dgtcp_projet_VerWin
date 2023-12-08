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

            'num_ifu' => $thisfaker->unique()->randomNumber(13),
            'prenom' => $thisfaker->firstName,
            'profess' => $faker->jobTitle(),
            'tel' => $thisfaker->phoneNumber,
            'banque' => $thisfaker->randomElement($banques),
            'num_compt' => $thisfaker->bankAccountNumber,
            'type_prs' => $thisfaker->randomElement(['personne_physique', 'personne_morale']),
            'nationalite' => $thisfaker->country,
            'boite' => $thisfaker-postcode(),
            'adresse' => $thisfaker->address,
            'nomsociete' => $thisfaker->company,
            'email' => $thisfaker->email,
            'categorie' =>$thisfaker->randomElement(['importatrice', 'exportatrice', 'autre']),

        ];
    }
}
