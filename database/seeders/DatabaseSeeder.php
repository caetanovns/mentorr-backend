<?php

namespace Database\Seeders;

use App\Models\Mentor;
use App\Models\Skill;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            SkillSeeder::class
        );

        $amount = 20;

        User::factory($amount)->create();
        Mentor::factory($amount)->create();

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'devops',
                'password' => Hash::make('devops'),
            ]
        );
    }
}
