<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'bio' => $this->faker->sentence(),
            'location' => $this->faker->city(),
            'avatar' => $this->faker->imageUrl(),
            'website' => $this->faker->url(),
        ];
    }
}
