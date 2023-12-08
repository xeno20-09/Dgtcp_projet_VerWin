<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\demandeurM>
 */
class DemandeurMFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $banques = [
            "Bank of Africa Bénin",
            "Banque internationale du Bénin",
            "Banque de l'habitat du Bénin",
            "Ecobank",
            "Orabank Bénin",
            "United Bank of Africa",
            "Diamond Bank",
            "Société générale de banques du Bénin",
            "Banque Sahélo-Saharienne pour l’Investissement et le Commerce",
            "Banque atlantique du Bénin",
            "BGFIBank Bénin",
            "Afriland first bank benin",
            "Banque Africaine pour l'Investissement et le Commerce (BAIC)",
            "CBAO surcusale Attijariwafa Bank",
            "Coris-Bank Bénin",
        ];
        $min = 1000000000000; // Minimum 13-digit number
        $max = 9999999999999; // Maximum 13-digit number

        $number = $this->faker->unique()->numberBetween($min, $max);
        $numberAsString = strval($number);

        $min_compt = 1000000000000; // Minimum 13-digit number
        $max_compt = 9999999999999; // Maximum 13-digit number

        $numbercompt = $this->faker->unique()->numberBetween($min, $max);
        $numberAsStringcompt = strval($number_compt);
        return [


            'tel' => $this->faker->phoneNumber,
            'date_open' => $this->faker->date($format = 'D-m-y', $max = '2003', $min = '1990'),

            'num_ifu' => $numberAsString,
            'tel' => $this->faker->phoneNumber,
            'banque' => $this->faker->randomElement($banques),
            'num_compt' => $this->faker->bankAccountNumber,
            'boite' => $this->faker->postcode(),
            'adresse' => $this->faker->address,
            'nomsociete' => $this->faker->company,
            'email' => $this->faker->email,
            'categorie' => $this->faker->randomElement(['importatrice', 'exportatrice', 'autre']),

        ];
    }
}
