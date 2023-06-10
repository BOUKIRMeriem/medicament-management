<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{   /**
    * Define the model's default state.
    *
    * @var string
    */
    protected $model = Patient::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'cin' => $this->faker->unique()->randomNumber(8),
        'nom' => $this->faker->lastName(),
        'prenom' => $this->faker->firstName(),
        'date_Naissance' => $this->faker->date(),
        'adresse' => $this->faker->address(),
        'telephone' => $this->faker->phoneNumber(),
        'adresse_Email' => $this->faker->safeEmail(),
        'sexe' => $this->faker->randomElement(['homme', 'femme']),
        'mutuelle' => $this->faker->randomElement(['Cnops', 'CNSS', 'Autres']),

        ];
    }
}
