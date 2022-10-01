<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::create([
            'uuid' => Str::uuid(),
            'title' => 'Student',
            'description' => '',
            'image' => null,
        ]);

        Card::create([
            'uuid' => Str::uuid(),
            'title' => 'Loyalty',
            'description' => '',
            'image' => null,
        ]);

        Card::create([
            'uuid' => Str::uuid(),
            'title' => 'Priority',
            'description' => '',
            'image' => null,
        ]);
    }
}
