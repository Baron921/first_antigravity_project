<?php

namespace Database\Factories;

use App\Models\JobOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOffer>
 */
class JobOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $villesBenin = ['Cotonou', 'Porto-Novo', 'Parakou', 'Abomey-Calavi', 'Ouidah', 'Natitingou', 'Bohicon', 'Kandi', 'Djougou', 'Lokossa'];
        $salaireMin = fake()->numberBetween(15, 40) * 10000;
        $salaireMax = $salaireMin + fake()->numberBetween(10, 50) * 10000;

        return [
            'user_id' => User::factory()->company(),
            'title' => fake()->jobTitle(),
            'description' => fake()->realText(500),
            'location' => fake()->randomElement($villesBenin) . ', Bénin',
            'salary' => number_format($salaireMin, 0, ',', ' ') . ' - ' . number_format($salaireMax, 0, ',', ' ') . ' FCFA / mois',
            'is_active' => true,
        ];
    }
}
