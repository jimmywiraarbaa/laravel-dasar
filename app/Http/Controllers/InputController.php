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

    public function arrayInput(Request $request): string
    {
        $names = $request->input("products.*.name");
        return json_encode($names);
    }

    public function inputType(Request $request)
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birth_date', 'd-m-Y');

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth_date' => $birthDate->format('d-m-Y')
        ]);
    }

    public function filterOnly(Request $request)
    {
        $name = $request->only("name.first", "name.last");
        return json_encode($name);
    }

    public function filterExcept(Request $request)
    {
        $user = $request->except("admin");
        return json_encode($user);
    }
}
