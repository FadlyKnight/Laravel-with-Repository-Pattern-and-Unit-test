<?php

namespace Database\Seeders;

use App\Models\Reference;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $name = [
            "Salary / 173",
            "Fixed"
        ];
        $expression = [
            "(salary / 173) * overtime_duration_total",
            "10000 * overtime_duration_total"
        ];
        for ($loopIndex=0; $loopIndex <= 1; $loopIndex++) { 
            Reference::factory()->create([
                "name" => $name[$loopIndex],
                "expression" => $expression[$loopIndex],
            ]);
        }
    }
}
