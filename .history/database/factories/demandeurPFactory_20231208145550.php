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
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,

            'tel' => $this->faker->phoneNumber,
            'date_birth' => $this->faker->date($format = 'D-m-y', $max = '2003', $min = '1970'),

            'num_ifu' => $this->faker->unique()->randomNumber(13),
            'profess' => $this->faker->jobTitle(),
            'tel' => $this->faker->phoneNumber,
            'banque' => $this->faker->randomElement($banques),
            'num_compt' => $this->faker->bankAccountNumber,
            'nationalite' => $this->faker->country,
            'boite' => $this->faker->postcode(),
            'adresse' => $this->faker->address,
            'email' => $this->faker->email,

        ];
    }
}
