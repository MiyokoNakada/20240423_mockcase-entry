<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\RegisterResponse as Contract;

class CustomRegisterResponse implements Contract
{
    public function toResponse($request)
    {
        return redirect()->route('verify');
    }
}
