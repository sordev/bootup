<?php

namespace App\Http\Middleware;

use Closure;

class TagstripMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!in_array(strtolower($request->method()), ['put', 'post'])) {
            return $next($request);
        }

        $input = $request->all();

        array_walk_recursive($input, function(&$input) {
            $input = strip_tags($input,'<p><b><strong><i><ul><li><table><img><hr><a><h2><h3><h4><pre><code>');
        });

        $request->merge($input);

        return $next($request);
    }
}
