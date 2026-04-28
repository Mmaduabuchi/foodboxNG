<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Package;
use App\Models\Subscription;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Subscription::class;
    public function definition(): array
    {
        $status = $this->faker->randomElement([
            Subscription::STATUS_ACTIVE,
            Subscription::STATUS_PENDING,
            Subscription::STATUS_PAUSED,
            Subscription::STATUS_CANCELLED,
        ]);

        $startDate = $this->faker->dateTimeBetween('-6 months', 'now');
        $endDate = Carbon::parse($startDate)->addMonths($this->faker->numberBetween(1, 12));

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'package_id' => Package::inRandomOrder()->first()?->id ?? Package::factory(),
            'status' => $status,
            'delivery_frequency' => $this->faker->randomElement(['weekly','monthly']),
            'delivery_zone' => $this->faker->randomElement([
                'Abuja Central',
                'Garki',
                'Wuse',
                'Maitama',
                'Asokoro',
                'Gwarinpa',
                'Kubwa',
                'Lugbe',
                'Lokogoma',
                'Apo',
                'Jabi',
                'Life Camp',
                'Dawaki',
                'Karu',
                'Nyanya',
                'Mararaba',
                'Kuje',
                'Bwari',
            ]),
            'next_renewal_date' => $endDate,
            'last_renewal_date' => $startDate,
            'paused_at' => $status === Subscription::STATUS_PAUSED ? $this->faker->dateTimeBetween('-1 month', 'now') : null,
            'cancelled_at' => $status === Subscription::STATUS_CANCELLED ? $this->faker->dateTimeBetween('-1 month', 'now') : null,
            'created_at' => $startDate,
            'updated_at' => $this->faker->dateTimeBetween($startDate, 'now'),
        ];
    }

    public function active()
    {
        return $this->state(fn () => [
            'status' => Subscription::STATUS_ACTIVE,
            'paused_at' => null,
            'cancelled_at' => null,
        ]);
    }

    public function cancelled()
    {
        return $this->state(fn () => [
            'status' => Subscription::STATUS_CANCELLED,
            'cancelled_at' => now(),
        ]);
    }
}
