<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput() {
        $this->get('/input/hello?name=risky')->assertSeeText('Hello risky');
        $this->post('/input/hello', ['name' => 'risky'])->assertSeeText('Hello risky');
    }

    public function testNestedInput() {
        $this->post('/input/hello/firstname', 
            ['name' => [ 
                    'first' => 'risky',
                    'last' =>  'kurniawan'
                ]
        ])->assertSeeText('Hello risky');
        
        $this->post('/input/hello/lastname', 
            ['name' => [ 
                    'first' => 'risky',
                    'last' =>  'kurniawan'
                ]
        ])->assertSeeText('Hello kurniawan');
    }

    public function testInputAll() {
        $this->post('/input/hello/input', 
            ['name' => [ 
                    'first' => 'risky',
                    'last' =>  'kurniawan'
                ]
        ])->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('last')
            ->assertSeeText('risky')
            ->assertSeeText('kurniawan');
    }

    public function testArrayInput() {
        $this->post('/input/hello/array',   [
            'products' => [
                    [
                        'name' => 'Apple M1',
                        'price' => 10,
                    ],
                    [
                        'name' => 'Samsung Z Fold 4',
                        'price' => 20
                    ],
                ]
            ])->assertSeeText('Apple M1')->assertSeeText('Samsung Z Fold 4');
    }
    
    public function testInputType() {
        $this->post('/input/type',  [
            'name' => 'risky',
            'married' => 'false',
            'birth_date' => '2014-01-01',
        ])->assertSeeText('risky')
            ->assertSeeText('false')
            ->assertSeeText('2014-01-01');
    }
    public function testFilterOnly() {
        $this->post('/input/filter/only',  [
            "name" => [
                'first' => 'risky',
                'middle' => 'gak ada',
                'last' => 'kurniawan',
            ],
            'married' => 'false',
            'birth_date' => '2014-01-01',
        ])->assertSeeText('risky')
            ->assertSeeText('kurniawan')
            ->assertDontSeeText('2014-01-01')
            ->assertDontSeeText('gak ada')
            ->assertDontSeeText('false');
    }
    public function testFilterExcpect() {
        $this->post('/input/filter/except',  [
            "name" => [
                'first' => 'risky',
                'middle' => 'gak ada',
                'last' => 'kurniawan',
            ],
            'password' => 'rahasia',
            'married' => 'false',
            'birth_date' => '2014-01-01',
        ])->assertSeeText('risky')
            ->assertSeeText('kurniawan')
            ->assertSeeText('2014-01-01')
            ->assertSeeText('gak ada')
            ->assertSeeText('false')
            ->assertDontSeeText('rahasia');
    }
    public function testFilterMerge() {
        $this->post('/input/filter/merge',  [
            "admin" => "true",
            "username" => "sebuah username",
            "password" => 'sebuah password',
        ])->assertSeeText('sebuah username')
            ->assertSeeText('sebuah password')
            ->assertSeeText('false');
    }
}
