<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseConnectionTest extends TestCase
{
    /**
     * A basic feature test example.
     * @return void
     */
    public function testDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
        }
        catch (\Exception $e){
            $this->fail("Failed to connect to database: " . $e->getMessage());
        }
        $this->assertTrue(true);
    }
}
