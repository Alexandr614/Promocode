<?php

namespace Database\Factories;

use App\Models\Promocodes;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromocodesFactory extends Factory
{


    protected $model = Promocodes::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (rand() % 2 == 0) {
            $percent = $this->faker->numberBetween(0, 100);
            $value_abs = null;
        } else {
            $percent = null;
            $value_abs = $this->faker->numberBetween(100, 10000);
        }

        $min_sum = $this->faker->numberBetween($value_abs, 100000);
        $date = $this->faker->date('Y-m-d', '2030-12-31');
        $number_of_uses = $this->faker->numberBetween(0, 100);

        if ($date <= date("Y-m-d") || $number_of_uses == 0) {
            $active = false;
        } else {
            $active = true;
        }
        return [
            'code' => $this->faker->unique()->asciify('******'),
            'percent' => $percent,
            'value_abs' => $value_abs,
            'min_sum' => $min_sum,
            'date_close' => $date,
            'number_of_uses' => $number_of_uses,
            'active' => $active
        ];
    }
}
