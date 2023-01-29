<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Str;

class ServerSeeder extends Seeder
{
    public function run(): void
    {
        User::inRandomOrder()
            ->limit(5)
            ->each(
                fn (User $user) =>
                    $user
                        ->setExtra('description', Str::random(random_int(16, 100)))
                        ->setExtra('server', true)
                        ->save()
            );
    }
}
