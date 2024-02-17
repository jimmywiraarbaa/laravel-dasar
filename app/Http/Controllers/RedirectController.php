<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "Redirect To";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    public function redirectName(): RedirectResponse
    {
        return redirect()->route('redirect-Hello', [
            'name' => 'Jimmy'
        ]);
    }

    public function redirectHello(string $name)
    {
        return "Hello " . $name;
    }

    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'Jimin']);
    }

    public function redirectAway(): RedirectResponse
    {
        return redirect()->away('https://www.youtube.com/');
    }
}
