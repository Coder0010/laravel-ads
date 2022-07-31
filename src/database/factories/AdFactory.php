<?php

namespace MKamelMasoud\Ads\Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use MKamelMasoud\Ads\Models\Ad;
use MKamelMasoud\Ads\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->name,
            'description' => $this->faker->paragraph,
            'category_id' => Category::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'start_date'  => Carbon::today()->addDays(rand(1, 4))
        ];
    }

    /**
     * Indicate that the model's type to be free.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function freeType()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Ad::FREE,
            ];
        });
    }

    /**
     * Indicate that the model's type to be paid.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function paidType()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Ad::PAID,
            ];
        });
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Ad $entity) {
            $entity->attachTags(['tag 1', 'tag 2']);
        });
    }
}
