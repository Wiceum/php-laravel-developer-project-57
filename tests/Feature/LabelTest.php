<?php

namespace Tests\Feature;

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

}
