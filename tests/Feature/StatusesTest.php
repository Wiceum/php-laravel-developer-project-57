<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Database\Factories\TaskStatusFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusesTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_user_can_create_status()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->sentence
        ];

        $this->post('/task_statuses', $attributes)->assertRedirect('/task_statuses');
        $this->assertDatabaseHas('task_statuses', $attributes);
        $this->get('/task_statuses')->assertSee($attributes['name']);
    }

    public function test_status_validation()
    {
        $this->post('/task_statuses', [])->assertSessionHasErrors('name');
    }

    public function test_show_method()
    {
        TaskStatus::factory()->create();
        $this->get('/task_statuses/1')->assertForbidden();
    }

    public function test_delete_method()
    {
        //guest cant delete status
        TaskStatus::factory()->create();
        $this->delete('/task_statuses/1')->assertForbidden();
        $this->assertDatabaseCount('task_statuses', 1);

        //user can delete status
        $this->signIn()->delete('/task_statuses/1')->assertRedirect();
        $this->assertDatabaseCount('task_statuses', 0);
    }

    public function test_update_method()
    {
        TaskStatus::factory()->create();
        $this->signIn()->put('/task_statuses/1', ['name' => 'Test']);
        $this->assertDatabaseHas('task_statuses', ['id' => 1, 'name' => 'Test']);
    }
}
