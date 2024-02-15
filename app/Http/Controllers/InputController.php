<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request)
    {
        $name = $request->input('name');
        return "Hello $name";
    }

    public function testInput()
    {
        $this->get('/input/hello?name=Jimmy')->assertSeeText("Halo Jimmy");

        $this->post('/input/hello', ['name' => 'Wira'])->assertSeeText("Halo Wira");
    }
}
