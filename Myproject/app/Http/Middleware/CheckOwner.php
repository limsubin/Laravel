<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Article;
use Alert;

class CheckOwner
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
        $user = Auth::user();
        $id = $request->id;
        $b = Article::find($id);
        if(!$b || $user->name != $b->writer){
            alert()->error('이 글을 수정할 권한이 없습니다', '경고');
            return back();
        }
            
        return $next($request);
    }
}
