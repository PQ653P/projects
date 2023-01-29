<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition() : array
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'postcode' => $this->faker->postcode(),
            'street' => $this->faker->streetAddress()
        ];
    }
}
