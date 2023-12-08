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
        $banques=[Bank of Africa Bénin
        Banque internationale du Bénin
        <option value="Banque de l'habitat du Bénin">Banque de l'habitat du Bénin
        <option value="Ecobank">Ecobank
        <option value="Orabank Bénin">Orabank Bénin
        <option value="United Bank of Africa">United Bank of Africa
        <option value="Diamond Bank">Diamond Bank
        <option value="Société générale de banques du Bénin">Société générale de banques du Bénin
        <option value="Banque Sahélo-Saharienne pour l’Investissement et le Commerce">Banque Sahélo-Saharienne pour l’Investissement et le Commerce
        <option value="Banque atlantique du Bénin">Banque atlantique du Bénin
        <option value="BGFIBank Bénin">BGFIBank Bénin
        <option value="Afriland first bank benin">Afriland first bank benin
        <option value="Banque Africaine pour l'Investissement et le Commerce (BAIC)">Banque Africaine pour l'Investissement et le Commerce (BAIC)
        <option value="CBAO surcusale Attijariwafa Bank">CBAO surcusale Attijariwafa Bank
        <option value="Coris-Bank Bénin">Coris-Bank Bénin];
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,

            'tel' => $this->faker->phoneNumber,
            'date_birth' => $this->faker->date($format = 'D-m-y', $max = '2003', $min = '1970'),

            'num_ifu' => $this->faker->unique()->randomNumber(13),
            'prenom' => $this->faker->firstName,
            'profess' => $this->faker->jobTitle(),
            'tel' => $this->faker->phoneNumber,
            'banque' => $this->faker->randomElement($banques),
            'num_compt' => $this->faker->bankAccountNumber,
            'type_prs' => $this->faker->randomElement(['personne_physique', 'personne_morale']),
            'nationalite' => $this->faker->country,
            'boite' => $this->faker->postcode(),
            'adresse' => $this->faker->address,
            'nomsociete' => $this->faker->company,
            'email' => $this->faker->email,
            'categorie' =>$this->faker->randomElement(['importatrice', 'exportatrice', 'autre']),

        ];
    }
}
