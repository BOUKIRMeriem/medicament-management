<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ordonnance;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ordonnance>
 */
class OrdonnanceFactory extends Factory

{/**
    * Define the model's default state.
    *
    * @var string
    */
    protected $model = Ordonnance::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {  $consultationIds = \App\Models\Consultation::pluck('id')->all();
        return [
            'medicament' => $this->faker->word(),
            'date' => $this->faker->date(),
            'dosage' => $this->faker->randomElement(['5 mg', '10 mg', '15 mg', '20 mg']),
            'nbr_fois' => $this->faker->randomElement(['1 fois par jour', '2 fois par jour', '3 fois par jour']),
            'qte' => $this->faker->randomNumber(2),
            'consultation_id' => $this->faker->randomElement($consultationIds),
        ];
}

}
