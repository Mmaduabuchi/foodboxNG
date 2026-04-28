<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Package;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Package::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Student Pack',
                'Family Pack',
                'Bachelor Pack',
                'Starter Kit',
                'Premium Kitchen Box',
            ]),
            'price' => $this->faker->numberBetween(5000, 50000),
            'billing_cycle' => $this->faker->randomElement([
                'monthly',
                'weekly',
            ]),

            'description' => $this->faker->sentence(10),
            'image' => $this->faker->imageUrl,
            'is_available' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
