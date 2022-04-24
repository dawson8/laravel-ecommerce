<?php

namespace App\Cart;

use App\Cart\Contracts\CartInterface;
use Illuminate\Session\SessionManager;

class Cart implements CartInterface
{
    public function __construct(protected SessionManager $session)
    {
        //
    }

    public function create()
    {
        dd($this->session);
    }
}
