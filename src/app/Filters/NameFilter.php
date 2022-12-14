<?php

namespace MKamelMasoud\Ads\Filters;

use Closure;

class NameFilter
{
    public function handle($request, Closure $next)
    {
        if (! request()->has('name')) {
            return $next($request);
        }

        return $next($request)->where('name', 'like', '%'.request('name').'%');
    }
}
