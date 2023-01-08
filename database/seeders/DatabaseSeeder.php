<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Database\Factories\TaskFactory;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::truncate();
        Task::truncate();
        User::truncate();

        TaskStatus::create(['name' => 'новая']);
        TaskStatus::create(['name' => 'завершена']);
        TaskStatus::create(['name' => 'выполняется']);
        TaskStatus::create(['name' => 'в архиве']);

        User::create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password'=>'$2y$10$ZmpI3LXaNELSDspCoCpJ/ePtFJAHGR0weAlKFT7mfs7C4ox2CvT1y',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)]
        );

    }
}
