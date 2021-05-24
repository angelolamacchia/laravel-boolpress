<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckApiToken
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
        //definisco il token
        $auth_token = $request->header('Authorization');

        //controllo che ci sia il token
        if (empty($auth_token)) {
            return response()->json([
                'success'=>false,
                'error'=>'Api token missed'
            ]);
        }

        //rimuovo la dicitura Bearer
        $api_token = substr($auth_token, 7);
        
        //confronto i token e verifico che sia giusto
        $user = User::where('api_token', $api_token)->first();
        if (!$user) {
            return response()->json([
                'success'=>false,
                'error'=>'Wrong api token'
            ]);
        }

        return $next($request);
    }
}
