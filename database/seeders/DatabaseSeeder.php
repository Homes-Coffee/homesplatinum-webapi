<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CardSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\StoreSeeder;
use Database\Seeders\CustomerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StoreSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(CardSeeder::class);

        // env != production
        if (env('APP_ENV') == 'local'){
            $this->call(CustomerSeeder::class);
        }
    }
}
