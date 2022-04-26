<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutIndexController extends Controller
{
    public function __invoke()
    {
        return view('checkout');
    }
}
