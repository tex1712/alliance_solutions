<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->word,
            'total' => $this->faker->numberBetween(1000, 100000),
            'date' => $this->faker->dateTimeThisYear,
            'client_id' => Client::all()->random()->id
        ];

    }
}
