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
}
