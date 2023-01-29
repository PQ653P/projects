<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition() : array
    {
        return [
            'src' => 'img/placeholder.png' // TO-DO implement
        ];
    }
}
