<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = User::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'role_id' => Role::first()->id ?? Role::factory()->create(),
            'email_verified_at' => $this->faker->dateTime(),
            'password' => bcrypt($this->faker->password),
            'remember_token' => Str::random(10),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
