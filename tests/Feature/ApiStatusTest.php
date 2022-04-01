<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ApiStatusTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_api_status_getRoles()
    {
        $response = $this->get('/api/angular/getroles');
 
        $response->assertStatus(200);
    }
    
    public function test_api_status_countAnswers()
    {
        $response = $this->get('/api/angular/countanswers');
 
        $response->assertStatus(200);
    }
    
    public function test_api_status_countQuestions()
    {
        $response = $this->get('/api/angular/countquestions');
 
        $response->assertStatus(200);
    }
    
    public function test_api_status_countusers()
    {
        $response = $this->get('/api/angular/countusers');
 
        $response->assertStatus(200);
    }
    
    public function test_api_status_countforms()
    {
        $response = $this->get('/api/angular/countforms');
 
        $response->assertStatus(200);
    }
    public function test_api_status_GetLast10Days()
    {
        $response = $this->get('/api/angular/getlast10days');
 
        $response->assertStatus(200);
    }
}
