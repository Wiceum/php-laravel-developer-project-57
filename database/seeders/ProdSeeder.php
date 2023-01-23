<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use Database\Factories\LabelFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $labels = Label::all();
        User::factory()->count(15)->create();
        Task::factory()->count(15)->sequence(fn ($sequence) => [
            'created_by_id' => rand(2,16),
            'assigned_to_id' => rand(2, 16),
        ])
            ->create()
            ->each(function ($task) use ($labels) {
                $task->labels()->attach($labels->random(rand(1,4)));
            });
    }
}
