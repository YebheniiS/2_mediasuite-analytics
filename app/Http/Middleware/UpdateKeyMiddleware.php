<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CreditsController;
use Closure;

class UpdateKeyMiddleware
{

    const APPROVED_API_KEYS = [
        'local' => 'Q2TEC6rAzFUrDhDb',
        'staging' => 'FMP5mNHTU7jnmaWy',
        'production' => 'wDUusQ4gRy2FTsDV',
    ];

    /**
     * @param $key
     * @return bool
     */
    private function keyExists($key)
    {
        return in_array($key, UpdateKeyMiddleware::APPROVED_API_KEYS);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->keyExists($request->apiKey)) {
            return $next($request);
        } else {
            return abort(400, 'Unknown api key');
        }
    }
}
