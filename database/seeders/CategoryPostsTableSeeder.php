<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use Illuminate\Database\Seeder;

class CategoryPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryPost::factory()->count(100)->create();
    }
}
