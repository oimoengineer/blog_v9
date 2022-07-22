<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Datetime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
                'title' => '命名の心得',
                'body' => '命名はデータを基準に考える',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('posts')->insert([
                'title' => 'エラー文',
                'body' => '読めるようになれば怖くない',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
   
    }
}
