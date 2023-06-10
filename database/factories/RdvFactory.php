<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rdv;
use App\Models\Patient;
use App\Models\Medecin;

class RdvFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'heure' => $this->faker->time('H:i'),
            'duree' => $this->faker->randomElement(['30 minutes', '1 heure', '1h30', '2 heures']),
            'commentaire' => $this->faker->sentence(),
            'patient_id' => Patient::inRandomOrder()->first()->id,
            'medecin_id' => Medecin::inRandomOrder()->first()->id,
        ];
    }
}
