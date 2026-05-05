<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user->role === 'Admin') {
            return redirect('/admin');
        }

        if ($user->role === 'Vendor') {
            return redirect('/vendor/dashboard');
        }

        if ($user->role === 'Delivery') {
            return redirect('/delivery/dashboard');
        }

        return redirect('/');
    }
}