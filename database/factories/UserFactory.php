<?php

namespace Database\Factories;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomNumber(8),
            'dv' => $this->faker->randomNumber(1),
            'name' => $this->faker->firstName(),
            'fathers_family' => $this->faker->lastName(),
            'mothers_family' => '',
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
            'position' => 'Médico',
            'organizational_unit_id' => '16'
        ];
    }
}

