<?php

namespace Database\Seeders;

use App\Models\Track;
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
        $testUser = User::factory()
            ->create([
                'name' => 'test_phpunit_user',
                'email' => 'test@example.com',
            ]);

        Track::factory()
            ->for($testUser, 'creator')
            ->create([
                'title' => 'test_phpunit_track',
            ]);
    }
}
