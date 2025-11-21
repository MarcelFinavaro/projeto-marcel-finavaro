<?php

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession as BaseStartSession;

class StartSession extends BaseStartSession
{
    public function handle($request, $next)
    {
        return parent::handle($request, $next);
    }
}
