<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //create some random users
        User::factory()
            ->count(3)
            ->create()
            ->each(function ($user) {
                $this->createCategoriesAndTasksForUser($user);
            });

        //create a user with a known email and password
        $myUser = User::factory()
            ->create([
                'email' => 'test@email.com',
                'password' => bcrypt('password'),
            ]);
        $this->createCategoriesAndTasksForUser($myUser);

    }

    /**
     * @param  User  $user
     * @return void
     */
    function createCategoriesAndTasksForUser(User $user): void
    {
        $categories = Category::factory()->count(3)->create(['user_id' => $user->id]);

        $categories->each(function ($category) use ($user) {
            Task::factory()
                ->count(5)
                ->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                ]);
        });
    }
}
