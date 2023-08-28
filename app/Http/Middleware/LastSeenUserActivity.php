<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
class LastSeenUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Set the locale to Indonesian ('id')
            Carbon::setLocale('id');
            if(!Cache::has('is_online' . Auth::user()->id)){
                $expireTime = Carbon::now()->addMinute(5); // keep online for 1 min
                Cache::put('is_online'.Auth::user()->id, true, $expireTime);
                //Last Seen
                User::where('id', Auth::user()->id)->update(['last_seen_at' => Carbon::now()]);
            }
        }
        return $next($request);
    }
}
