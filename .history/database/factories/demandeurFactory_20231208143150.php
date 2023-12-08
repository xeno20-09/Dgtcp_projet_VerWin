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
            'date_birth' => $this->faker->date($format = 'D-m-y', $max = '2003', $min = '1970');

            'num_ifu' => $faker->unique()->randomNumber(13),
            'prenom' => $faker->firstName,
            'profess' => $faker->word,
            'tel' => $faker->phoneNumber,
            'banque' => $faker->randomElement($banques),
            'num_compt' => $faker->bankAccountNumber,
            'type_prs' => $faker->randomElement(['personne_physique', 'personne_morale']),
            'nationalite' => $faker->country,
            'boite' => $faker->company,
            'adresse' => $faker->address,
            'nomsociete' => $faker->company,
            'email' => $faker->email,
            'categorie' => $faker->word,
        ];
    }
}
