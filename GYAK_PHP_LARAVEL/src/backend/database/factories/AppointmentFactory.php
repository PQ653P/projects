<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition() : array
    {
        return [
            'begin_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->dateTime(),
            'note' => $this->faker->text(),
            'user_id' => User::random()->id,
            'service_id' => Service::random()->id
        ];
    }
}
