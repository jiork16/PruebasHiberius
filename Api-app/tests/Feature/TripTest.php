<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_create_trip_successful()
    {
        $response = $this->postJson('/api/trips', [
            "vehicle_id"    =>1,
            "driver_id"  =>4,
            "date"    =>"2024-02-01"
        ]);
        $response->assertStatus(201);
    }
    public function test_create_trip_error()
    {
        $response = $this->postJson('/api/trips', [
            "driver_id"  =>4,
            "date"    =>"2024-02-01"
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => "The vehicle id field is required.",
        ]);
    }
}
