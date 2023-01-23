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

        $this->call([
            LabelSeeder::class,
            ProdSeeder::class
        ]);
    }
}
