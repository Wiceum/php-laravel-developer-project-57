<?php

namespace Tests\Feature;

use App\Models\Label;
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
}
