<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\volunteer_user;
use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        volunteer_user::factory(20)->create();
    }
}
