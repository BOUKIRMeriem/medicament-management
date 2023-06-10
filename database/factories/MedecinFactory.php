<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Medecin;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medecin>
 */
class MedecinFactory extends Factory
{   /**
    * Define the model's default state.
    *
    * @var string
    */
      protected $model = Medecin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
            return [
                'nom' => $this->faker->lastName(),
                'prenom' => $this->faker->firstName(),
                'email' => $this->faker->safeEmail(),
                'telephone' => $this->faker->phoneNumber(),
                'specialite' => $this->faker->randomElement(['Pédiatrie', 'Chirurgie', 'Radiologie']),
    
          
        ];
    }
}
