<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_create_label()
    {
        $this->get('/labels/create')->assertForbidden();

        $this->signIn()->get('/labels/create', ['Accept-Language' => 'ru'])
            ->assertSee(['Создать метку', 'Имя', 'Описание']);
        $this->signIn()->get('/labels/create', ['Accept-Language' => 'en'])
            ->assertSee(['Create a label', 'Name', 'Description']);
    }

    public function test_store_label()
    {
        $this->post('/labels', ['name' => 'test_label'])->assertForbidden();

        $this->signIn()->post('/labels', ['name' => '', 'description' => '123'])->assertSessionHasErrors();

        $this->signIn()->post('/labels', ['name' => 'test_label']);
        $this->assertDatabaseHas('labels', ['name' => 'test_label']);
    }

    public function test_show_label()
    {
        Label::factory()->create(['name' => 'test']);
        $this->get('/labels/1')->assertForbidden();
    }

    public function test_edit_label()
    {
        Label::factory(['name' => 'test_label_name', 'description' => 'test_label_description'])->create();
        $this->get('labels/1/edit')->assertForbidden();
        $this->signIn()->get('labels/1/edit')->assertSee(['test_label_name', 'test_label_description']);
    }

    public function test_update_label()
    {
        Label::factory()->create();
        $this->patch('/labels/1', ['name' => 'test'])->assertForbidden();
        $this->signIn()->patch('/labels/1', ['name' => 'test_name']);
        $this->assertDatabaseHas('labels', ['name' => 'test_name']);
    }

    public function test_delete_label()
    {
        Label::factory()->create();
        $this->delete('/labels/1')->assertForbidden();
        $this->signIn()->delete('/labels/1');
        $this->assertDatabaseCount('labels', 0);
    }

    public function test_delete_attached_label()
    {
        $this->seed();
        $user = \App\Models\User::factory()->create(['name' => 'test_user_2']);
        $label = Label::factory()->create(['name' => 'test_label']);
        $task = Task::factory()->create(['name' => 'test_task_2', 'created_by_id' => $user->id]);
        $task->labels()->attach($label);

        $this->delete($label);
        $this->assertDatabaseHas('labels', ['id' => $label->id, 'name' => $label->name]);
    }
}
