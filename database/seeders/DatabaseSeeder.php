<?php

namespace Database\Seeders;

use App\Models\Channel;
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
        Channel::create([
            'name' => 'Javascript',
            'slug' => 'javascript'
        ]);
        Channel::create([
            'name' => 'Php',
            'slug' => 'php'
        ]);
        Channel::create([
            'name' => 'Web Development',
            'slug' => 'web-development'
        ]);
        Channel::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);
        Channel::create([
            'name' => 'Frontend',
            'slug' => 'frontend'
        ]);
        Channel::create([
            'name' => 'backend',
            'slug' => 'backend'
        ]);
        //answered
        $threads = Thread::factory(30)->create();
        $threads->each(function ($thread) {Reply::factory(rand(0, 15))->create(['thread_id' => $thread->id]);});

        Thread::factory(10)->create();// unanswered thread
    }
}
