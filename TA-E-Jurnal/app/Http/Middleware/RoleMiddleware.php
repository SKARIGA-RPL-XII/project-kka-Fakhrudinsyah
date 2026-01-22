<?php

use Illuminate\Routing\Controllers\Middleware;

class RoleMiddleware extends Middleware
{
    public function RoleMiddleware()
    {
        if (session('role') !== 'admin') {
            abort(403);
        }
    }
}
