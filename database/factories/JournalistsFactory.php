<?php

namespace Database\Factories;

use App\Models\Journalists;
use Illuminate\Database\Eloquent\Factories\Factory;

class JournalistsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Journalists::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name'        => $this->faker->name,
            'description' => $this->faker->sentence( 12 ),
            'image'       => 'testimage.jpg',
        ];
    }
}
