<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        return response('Hello from Laravel Controller!');
    }
}
