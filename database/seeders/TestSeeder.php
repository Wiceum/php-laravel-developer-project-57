<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Str;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                'name' => 'test_user',
                'email' => 'test_user@example.com',
                'password'=>'$2y$10$ZmpI3LXaNELSDspCoCpJ/ePtFJAHGR0weAlKFT7mfs7C4ox2CvT1y',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10)]
        );

        Task::create([
            'name' => 'First test task',
            'description' => 'Any test description',
            'status_id' => 1,
            'created_by_id' => 1,
            'assigned_to_id' => 1
        ]);    }
}
