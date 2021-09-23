<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Factory2;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;
//        $faker = Factory2::create('ko_KR');
//        dd($faker->name);

        return [
            'title' => $faker->company(),
            'content' => $faker->realText(30, 3)
        ];
//        return [
//            'title' => $this->faker->word(),
//            'content' => $this->faker->paragraph(4)
//        ];
    }
}
