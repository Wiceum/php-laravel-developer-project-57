<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Database\Factories\TaskFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
Use App\Models\User;

class TasksTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_tasks_index()
    {
        $this->seed('TestSeeder');
        $task = Task::factory()->create(['created_by_id' => 1, 'assigned_to_id' => 1]);
        $status = $task->status->name;

        $this->get('tasks')->assertSee([$task->id, $task->name, $status]);
    }

    public function test_get_creation_page()
    {
        $this->get('tasks/create')->assertForbidden();
        $this->signIn()->get('tasks/create')->assertOk();
    }

    public function test_store_task()
    {
        TaskStatus::factory()->create();
        $user = User::factory()->create();
        $data = [
            'name' => 'test name',
            'description' => 'test description',
            'status_id' => 1,
            'created_by_id' => 1,
            'assigned_to_id' => 1,
        ];

        $this->post('tasks', $data)->assertForbidden();
        $this->actingAs($user)->post('tasks', $data)->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_show_task()
    {
        $this->seed('TestSeeder');
        $task = Task::factory()->create(['created_by_id' => 1, 'assigned_to_id' => 1]);

        $name = $task->name;
        $status = $task->status->name;
        $description = $task->description;


        $this->get('tasks/' . $task->id)
            ->assertOk()
            ->assertSee([$name, $status, $description]);

    }

    public function test_get_edit_page()
    {
        $this->seed('TestSeeder');
        $task = Task::factory()->create(['created_by_id' => 1, 'assigned_to_id' => 1]);

        $this->get('tasks/'. $task->id. '/edit')->assertForbidden();
        $this->signIn()->get('tasks/'. $task->id. '/edit')->assertSee([
            $task->name,
            $task->description,
            $task->status->name,
            $task->executor->name
        ]);
    }

    public function test_update_task()
    {
        $this->seed('TestSeeder');
        $task = Task::factory()->create(['created_by_id' => 1, 'assigned_to_id' => 1]);

        $this->patch('tasks/'. $task->id)->assertForbidden();
        $this->signIn()->patch('tasks/'. $task->id, [
            'name' => 'test name',
            'description' => 'test description',
            'status_id' => '1',
            'assigned_to_id' => '1'
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'test name',
            'description' => 'test description'
        ]);
    }

    public function test_author_can_delete_task()
    {
        $user_1 = User::factory()->create(); //author
        $user_2 = User::factory()->create();
        TaskStatus::factory()->count(4)->create();
        $task = Task::factory()->create(['created_by_id' => $user_1->id, 'assigned_to_id' => $user_1->id]);

        $this->actingAs($user_2)->delete('/tasks/'. $task->id)->assertForbidden();
        $this->actingAs($user_1)->delete('/tasks/'. $task->id)
            ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseCount('tasks', 0);
    }
}
