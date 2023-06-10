<?php

namespace Database\Factories;
use App\Models\Analyse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AnalyseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $consultationIds = \App\Models\Consultation::pluck('id')->all();
        return [
          
            'date' => $this->faker->date(),
            'special_instructions' => $this->faker->sentence(),
            'consultation_id' => $this->faker->randomElement($consultationIds),
        ];
    }
}
