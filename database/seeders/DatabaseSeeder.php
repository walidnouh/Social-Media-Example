<?php

namespace Database\Seeders;

use Carbon\Factory;
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
        // \App\Models\User::factory(10)->create();
        $users = \App\Models\User::factory()->count(10)->create();

        $posts = \App\Models\Post::factory()->count(10)->make()->each(function($post) use ($users){
            $post->user_id=$users->random()->id;
            $post->save();
        });

        $comments = \App\Models\Comment::factory()->count(10)->make()->each(function($comment) use ($posts,$users){
            $comment->post_id=$posts->random()->id;
            $comment->user_id=$users->random()->id;
            $comment->save();
        });
    }
}
