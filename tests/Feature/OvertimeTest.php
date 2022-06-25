<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OvertimeTest extends TestCase
{
    public function testRequiredFieldsOvertime()
    {
        $this->json('POST', 'api/overtimes', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "employee_id" => [
                        "The employee id field is required."
                    ],
                    "date" => [
                        "The date field is required."
                    ],
                    "time_started" => [
                        "The time started field is required."
                    ],
                    "time_ended" => [
                        "The time ended field is required."
                    ]
                ]
            ]);
    }

    public function testAddOverTime(){
        $data = [
            "employee_id" => 1,
            "date" => "2022-01-03",
            "time_started" => "10:00",
            "time_ended" => "23:00"
        ];
        $this->json('POST', 'api/overtimes', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message",
                "data" => [
                    "id",
                    "employee_id",
                    "date",
                    "time_started",
                    "time_ended",
                    "created_at",
                    "updated_at"
                ]
        ]);
    }

    public function testNotExistsEmployee(){
        $data = [
            "employee_id" => 9999,
            "date" => "2022-01-03",
            "time_started" => "10:00",
            "time_ended" => "23:00"
        ];
        $this->json('POST', 'api/overtimes', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "employee_id" => ["The selected employee id is invalid."],
                ]
        ]);
    }

    public function testNotIntegerEmployee(){
        $data = [
            "employee_id" => "a",
            "date" => "2022-01-03",
            "time_started" => "10:00",
            "time_ended" => "23:00"
        ];
        $this->json('POST', 'api/overtimes', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "employee_id" => [],
                ]
        ]);
    }

    public function testFormatDate(){
        
        $data = [
            "employee_id" => "1",
            "date" => "2022",
            "time_started" => "10:00",
            "time_ended" => "23:00"
        ];
        $this->json('POST', 'api/overtimes', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "date" => [],
                ]
        ]);
    } 
    
    public function testUniqueDateWithSameEmployeeId(){
        $data = [
            "employee_id" => 1,
            "date" => "2022-01-03",
            "time_started" => "10:00",
            "time_ended" => "23:00"
        ];
        $this->json('POST', 'api/overtimes', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "date" => [],
                ]
        ]);
    } 

    public function testFormatTimeStart(){
        $data = [
            "employee_id" => 1,
            "date" => "2022-01-04",
            "time_started" => "2022-10-11 10:00",
            "time_ended" => "23:00"
        ];
        $this->json('POST', 'api/overtimes', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "time_started" => [],
                ]
        ]);
    }
    
    public function testFormatTimeEnd(){
        $data = [
            "employee_id" => 1,
            "date" => "2022-01-04",
            "time_started" => "10:00",
            "time_ended" => "2022-10-11 23:00"
        ];
        $this->json('POST', 'api/overtimes', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "time_ended" => [],
                ]
        ]);
    } 
    
    public function testTimeStartBeforeTimeEnd(){
        $data = [
            "employee_id" => 1,
            "date" => "2022-01-04",
            "time_started" => "20:00",
            "time_ended" => "13:00"
        ];
        $this->json('POST', 'api/overtimes', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "time_started" => [],
                    "time_ended" => [],
                ]
        ]);
    }
}
