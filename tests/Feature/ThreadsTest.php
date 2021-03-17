<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use phpDocumentor\Reflection\Types\Parent_;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations,RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_should_see_all_threads()
    {
        $thread=Thread::factory()->create();
        $response = $this->get('/threads');
        $response->assertSee($thread->title);
    }
    public function test_a_user_should_see_single_thread()
    {
        $thread=Thread::factory()->create();
        $response = $this->get("/threads/".$thread->id);
        $response->assertSee($thread->title);
    }
}
