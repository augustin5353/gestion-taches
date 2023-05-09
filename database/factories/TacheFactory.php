<?php

namespace Database\Factories;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tache>
 */
class TacheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
   
    {

        return [
            'name' => $this->faker->sentence(6, true),
            'description' => $this->faker->sentences(5, true),
        ];
        
    }
}
