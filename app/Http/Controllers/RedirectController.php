<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "Redirect to";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    public function redirectName(): RedirectResponse
    {
        return redirect()->route('redirect-hello', ['name' => 'risky']);
    }

    public function redirectAction(): RedirectResponse
    {
        return redirect()->route('redirect-hello', ['name' => 'risky']);
    }

    public function redirectAway(): RedirectResponse
    {
        return redirect()->away('https://www.example.com');
    }

    public  function redirectHello(string $name): string
    {
        return "Hello $name";
    }
}
