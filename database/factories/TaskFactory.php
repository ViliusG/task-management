<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'due_date' => Carbon::now(),
            'status' => $this->faker->word(),
            'priority' => $this->faker->numberBetween(1, 10),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
