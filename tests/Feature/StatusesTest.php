<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusesTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testUserCanCreateStatus()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->sentence
        ];

        $this->post('/task_statuses', $attributes)->assertRedirect('/task_statuses');

        $this->assertDatabaseHas('task_statuses', $attributes);

        $this->get('/task_statuses')->assertSee($attributes['name']);
    }
}
