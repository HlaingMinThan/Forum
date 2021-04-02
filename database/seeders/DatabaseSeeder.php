<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\Thread;
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
        $threads = Thread::factory(50)->create();
        $threads->each(function ($thread) {Reply::factory(10)->create(['thread_id' => $thread->id]);});
    }
}
