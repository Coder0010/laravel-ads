<?php

namespace MKamelMasoud\Ads\Filters;

use Closure;

class TagFilter
{
    public function handle($request, Closure $next)
    {
        if (! request()->has('tag')) {
            return $next($request);
        }

        return $next($request)->whereHas('tags', function ($q) {
                $q->whereIn('id', [request()->has('tag')]);
            });
    }
}
