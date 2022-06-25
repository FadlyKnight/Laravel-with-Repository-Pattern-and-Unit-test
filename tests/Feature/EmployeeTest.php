<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    public function testRequiredFieldsEmployee()
    {
        $this->json('POST', 'api/employees', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name field is required."],
                    "salary" => ["The salary field is required."],
                ]
            ]);
    }

    public function testAddEmployee(){
        $data = [
            "name" =>"employee 1",
            "salary" => "2000000"
        ];
        $this->json('POST', 'api/employees', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "message" => "success",
        ]);
    }

    public function testNameUnique(){
        $data = [
            "name" =>"employee 1",
            "salary" => "2000000"
        ];
        $this->json('POST', 'api/employees', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name has already been taken."],
                ]
        ]);
    }

    public function testNameOnlyOneChar(){
        $data = [
            "name" =>"Z",
            "salary" => "2000000"
        ];
        $this->json('POST', 'api/employees', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name must be at least 2 characters."],
                ]
        ]);
    }

    public function testSalaryBelowTwoMillion(){
        $data = [
            "name" =>"employee 2",
            "salary" => "1000000"
        ];
        $this->json('POST', 'api/employees', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "salary" => ["The salary must be at least 2000000."],
                ]
        ]);
    }
    
    
    public function testSalaryGreaterTenMillion(){
        $data = [
            "name" =>"employee 3",
            "salary" => "20000000"
        ];
        $this->json('POST', 'api/employees', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "salary" => ["The salary may not be greater than 10000000."],
                ]
        ]);
    }
}
