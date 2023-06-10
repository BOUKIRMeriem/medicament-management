<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Radiologie;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Radiologie>
 */
class RadiologieFactory extends Factory
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
