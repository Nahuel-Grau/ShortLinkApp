<?php

namespace App\Http\Middleware;

use App\Models\ShortLink;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountClicks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('url'); 
        $shortLink = ShortLink::where('shortLink', $slug)->firstOrFail();
        $shortLink->count ++;
        $shortLink->save();
    
        return $next($request);
        
    }
}
