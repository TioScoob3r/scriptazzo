<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Bank;
use Auth;

class Banks
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
        // Aqui você busca bancos do usuário, mas não redireciona caso esteja vazio.
        $bank = Bank::where('user_id', Auth::guard('user')->user()->id)->get();

        // Prossegue para o dashboard normalmente, independente da existência de bancos.
        return $next($request);
    }
}
