<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Active
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
        if (!Auth::check())

            return redirect('login');

        $user = Auth::user();

        if(!$user->isActive())

            return redirect('/')->with(['flash-msg' => [
                    'status'=> trans('status.danger'),
                    'msg' => 'Fail',
                ],
            ]);

        return $next($request);
    }
}
