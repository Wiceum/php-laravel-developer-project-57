<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Database\Factories\TaskFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        if (env("DB_CONNECTION") === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        }

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

        if (env("DB_CONNECTION") === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        }
    }
}
