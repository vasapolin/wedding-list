<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $email = config('wedding.admin_email');
        $password = config('wedding.admin_password');

        $existing = User::query()->where('email', $email)->first();

        if (! $existing) {
            User::query()->create([
                'name' => 'Laura & Victor',
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);
        }

        $this->call([
            GiftSeeder::class,
            SiteAssetSeeder::class,
        ]);
    }
}
