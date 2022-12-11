<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

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

        TaskStatus::create(['name' => 'новая']);
        TaskStatus::create(['name' => 'завершена']);
        TaskStatus::create(['name' => 'выполняется']);
        TaskStatus::create(['name' => 'в архиве']);
    }
}
