<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Agar admin route hai to admin login pe bhejo, warna user login
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.login');
            }
            return route('user.login');
        }
        return null;
    }
}