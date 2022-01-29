<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key' => $this->faker->asciify('******************************'),
            'score' => $this->faker->randomElement(config('app.allowed_scores'))
        ];
    }
}
