<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function definition() : array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'extra' => json_encode(['something' => $this->faker->word()]),
            'duration' => $this->faker->numberBetween(10, 360),
            'user_id' => User::Servers()->inRandomOrder()->first()->id
        ];
    }
}
