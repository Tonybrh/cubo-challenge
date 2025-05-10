<?php

namespace Database\Seeders;

use App\Domain\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        Comment::factory()->count(10)->create();
    }
}
