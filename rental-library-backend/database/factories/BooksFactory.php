<?php

namespace Database\Factories;

use App\Models\Authors;
use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Books::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'is_borrowed' => random_int(0, 1),
            'author_id' => Authors::factory()
        ];
    }
}
