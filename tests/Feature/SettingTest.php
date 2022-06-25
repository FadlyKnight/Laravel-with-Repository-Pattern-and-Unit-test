<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingTest extends TestCase
{
    
    public function testRequiredFieldsSettings()
    {
        $this->json('PATCH', 'api/settings', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "key" => [
                        "The key field is required."
                    ],
                    "value" => [
                        "The value field is required."
                    ]
                ]
            ]);
    }

    public function testKeyRequest(){
        $data = [
            "key"=>"overtime_method_2",
            "value"=>"2"
        ];
        $this->json('PATCH', 'api/settings', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "key" => []
                ]
            ]);
    }
    
    public function testValueReference(){
        $data = [
            "key"=>"overtime_method",
            "value"=>"9"
        ];
        $this->json('PATCH', 'api/settings', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "value" => []
                ]
            ]);
    }
    
    public function testIsValidKeyAndValue(){
        $data = [
            "key"=>"overtime_method",
            "value"=>"2"
        ];
        $this->json('PATCH', 'api/settings', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message"
            ]);
    }

}
