<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\LogoutResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomLogoutResponse extends LogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        return redirect()->to(
            route('home')
        );
    }
}
