<?php

namespace App\Http\Middleware;
use Closure;

class KeyMiddleware
{
    const APPROVED_API_KEYS = [
        'local' => 'rDhDbEC6rAzFUQ2T',
        'staging' => 'aWyHTU7jFMP5mNnm',
        'production' => 'DVusQ4gRy2wDUFTs',
    ];
    /**
     * @param $key
     * @return bool
     */
    private function keyExists($key)
    {
        return in_array($key, KeyMiddleware::APPROVED_API_KEYS);
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
