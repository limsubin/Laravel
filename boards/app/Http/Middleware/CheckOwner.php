<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Board;

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
        //로그인 한 사용자와, 요청정보에 있는 id(게시글의 id)를 이용해 게시글을 DB에서 가져오고, 
        //그 가져온 게시글의 user_id와 비교 다르면 back(); 같으면 밑으로..
        
        $user = Auth::user();
        $id = $request->route('board');
        $b = Board::find($id);
        if(!$b || $user->id != $b->user_id){
            flash('권한이 없음')->error();
            return back();//view파일이 나온다
        }
            
        return $next($request);
    }
}
