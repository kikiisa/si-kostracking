<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use app\Services\MyService;
use Tests\TestCase;

class MyServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
       $init = new MyService();
       $response = $init->removeMultipleImage('167901598712.png');
       $this->assertTrue(true);
    }
}
