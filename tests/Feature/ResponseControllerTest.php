<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('response/hello')->assertSeeText('Hello response')->assertStatus(200);
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('risky')
            ->assertSeeText('kurniawan')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'risky kurniawan')
            ->assertHeader('App', 'example_app');
    }

    public function testView()
    {
        $this->get('/response/type/view')->assertSeeText('hello risky');
    }
    public function testJson()
    {
        $this->get('/response/type/json')->assertJson(['firstName' => 'risky', 'lastName' => 'kurniawan']);
    }
    public function testFile()
    {
        $this->get('/response/type/file')->assertHeader('Content-Type', 'image/png');
    }
    public function testDownload()
    {
        $this->get('/response/type/download')->assertDownload('riskykrnawan.png');
    }
}
