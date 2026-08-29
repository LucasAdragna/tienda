<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adragnadev@gmail.com'],
            [
                'name' => 'Lucas Admin',
                'email_verified_at' => '2026-05-06 13:04:13',
                'password' => Hash::make('Dev_777'),
                'remember_token' => '11111',
                'visible' => true,
                'activo' => true,
                'created_at' => '2026-05-06 13:01:27',
                'updated_at' => '2026-05-06 12:45:23',
            ]
        );

        $this->call(CategorySeeder::class);
    }
}
