<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class HttpsProtocol
{
    public function handle($request, Closure $next)
    {
	if (!$request->secure() && App::environment() === 'production') {
	    $request->setTrustedProxies([$request->getClientIp()], Request::HEADER_X_FORWARDED_ALL); 
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
