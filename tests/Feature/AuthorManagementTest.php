<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{

    use RefreshDatabase;

    public function test_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/authors', [
            'name' => 'Miau',
            'dob' => '08/12/1977',
        ]);

        $author = Author::all();

        dump($author->first()->name);
        dump($author->first()->dob);

        $this->assertCount(1,  $author);

        $this->assertInstanceOf(Carbon::class,  $author->first()->dob);
    }
}
