<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HelloService;

class HelloController extends Controller
{
    private HelloService $helloService;
    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }
    public function hello(): string {
        return $this->helloService->hello("Risky");
    }
}
