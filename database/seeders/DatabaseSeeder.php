<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Post::factory(3)->create();
        $this->call([
            UserSeeder::class, // ★ここを追加/確認！
            // もし今後、PostSeederなど他のSeederを作成したら、ここに追加していきます
            // PostSeeder::class,
            // CategorySeeder::class,
        ]);
    }
}
