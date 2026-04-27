<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdvocatedPermissionSeeder::class,
            ServiceContentSeeder::class,
            BlogContentSeeder::class,
            TeamContentSeeder::class,
            CareerContentSeeder::class,
            ProBonoContentSeeder::class,
            VideoContentSeeder::class,
            ContactContentSeeder::class,
            GalleryImageSeeder::class,
        ]);
    }
}
