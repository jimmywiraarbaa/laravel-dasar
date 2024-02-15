<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name');
        return "Halo $name";
    }

    public function helloFirstName(Request $request): string
    {
        $firstName = $request->input('name.first');
        return "Halo " . $firstName;
    }

    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }
}
