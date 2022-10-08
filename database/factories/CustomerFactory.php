<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid'      => Str::uuid(),
            'name'      => $this->faker->name(),
            'email'     => $this->faker->unique()->safeEmail,
            'whatsapp'  => $this->faker->unique()->numerify('08##########'),
            'password'      => Hash::make('password'),
            'photo'         => null,
        ];
    }
}
