<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculationOvertimeTest extends TestCase
{
    
    public function testRequiredFieldsCalculation()
    {
        $this->json('GET', 'api/overtime-pays/calculate', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "month" => [
                        "The month field is required."
                    ]
                ]
            ]);
    }

    public function testDateFormatRequestMonth(){
        $data = [
            'month' => '2022-10-01',
        ];
        $this->json('GET', 'api/overtime-pays/calculate', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "month" => [
                        "The month does not match the format Y-m."
                    ]
                ]
            ]);
    }

    
    public function testValidDateFormatWithResult(){
        $data = [
            'month' => '2022-01',
        ];
        $this->json('GET', 'api/overtime-pays/calculate', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message",
                "data" => [
                    0 => [
                        "id",
                        "name",
                        "salary",
                        "created_at",
                        "updated_at",
                        "overtime_duration_total",
                        "amount",
                        "overtime"=> [
                            0 => [
                                "employee_id",
                                "time_started",
                                "time_ended",
                                "date",
                                "overtime_duration",
                            ]
                        ]
                    ]
                ]
            ]);
    }
    
    public function testValidDateFormatWithNoResult(){
        $data = [
            'month' => '2022-11',
        ];
        $this->json('GET', 'api/overtime-pays/calculate', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message",
                "data" => []
            ]);
    }

    
    
}
