<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\app\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'mail' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'country' => $this->faker->country,
            'company' => $this->faker->company,
            'profession' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'message' => $this->faker->text,
        ];
    }
}
