<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;

class CheckCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Category::exists()) {
            return redirect()->route('categories.create')->with('error', 'Please create at least one category before proceeding.');
        }
        return $next($request);
    }
}
