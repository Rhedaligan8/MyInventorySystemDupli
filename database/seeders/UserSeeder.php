<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     "name" => "Mike Bacabis",
        //     "username" => "admin",
        //     "password" => Hash::make("admin"),
        //     "role" => "admin",
        //     "status" => "active"
        // ]);

        User::factory()
            ->count(50)
            ->hasLogs(0)
            ->create();
    }
}
