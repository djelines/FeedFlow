<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Organization;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::factory()->create()->id;
        $organizationId = Organization::factory()->create(['user_id' => $userId])->id;
        return [
            'organization_id' => $organizationId,
            'user_id' => $userId,
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(10),
            'is_anonymous' => fake()->boolean(),
            'is_closed' => false,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
