<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consultation;
use App\Models\Rdv;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
    * Define the model's default state.
    *
    * @var string
    */
    protected $model = Consultation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{     $rdvtId = Rdv::exists() ? Rdv::inRandomOrder()->first()->id : factory(Rdv::class)->create()->id;
  

    return [
   
        'date_consultation' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        'type_consultation' => $this->faker->randomElement(['consultation générale', 'consultation spécialisée', 'examen']),
        'diagnostic' => $this->faker->sentence(),
        'rdv_id' => $rdvtId,
    
    ];
}
}
