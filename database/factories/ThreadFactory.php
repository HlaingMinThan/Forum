<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        return [
            'user_id' => User::factory(),
            'channel_id' => rand(1, 6),
            'slug' => Str::slug($title),
            'title' => $title,
            'body' => $this->faker->paragraph(20),
        ];
    }
}
