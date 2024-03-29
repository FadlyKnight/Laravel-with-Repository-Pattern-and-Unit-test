<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OvertimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "employee_id" => 1,
            "date" => "2022-01-01",
            "time_started" =>  "10:00",
            "time_ended" =>  "19:00"
        ];
    }
}
