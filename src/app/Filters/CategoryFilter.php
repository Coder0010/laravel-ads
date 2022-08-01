<?php

namespace MKamelMasoud\Ads\Filters;

use Closure;

class CategoryFilter
{
    public function handle($request, Closure $next)
    {
        if (! request()->has('category')) {
            return $next($request);
        }

        return $next($request)->where('category_id', request('category'));
    }
}
