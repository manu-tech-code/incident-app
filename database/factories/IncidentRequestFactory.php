<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncidentRequest>
 */
class IncidentRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->randomNumber(),
            'caller' => $this->faker->name,
            'opened' => $this->faker->dateTime,
            'opened_by' => $this->faker->name,
            'location' => $this->faker->address,
            'impacted_item' => $this->faker->word,
            'category' => $this->faker->word,
            'priority' => $this->faker->word,
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'incident_state' => fake()->randomElement(['Pending', 'In Progress', 'Done']),
            'user_id' => fake()->randomNumber(1,1),
            'it_personnel_id' => fake()->randomNumber(1,1),
        ];
    }
}
