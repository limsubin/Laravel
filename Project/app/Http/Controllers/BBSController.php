<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\tagging_Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Alert;

class BBSController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['only'=>['destroy', 'edit', 'create']]);
        $this->middleware('own')->only(['update', 'destory']);
    }

    public function index(Request $request){
        return view('bbs.mainlayout');
    }

    public function show(Request $request){
        $id = $request->id;
        $page = $request->page;
        $inquiry = $request->inquiry;
        
        $articles = Article::find($id);
        $articles->update(['inquiry'=>$articles->$inquiry+1]);
            
        return view('bbs.view',compact('articles'))
               ->with('page',$page); 
    }
    
    public function list(Request $request){
        $page = $request->page;
        $pageMsgs = Article::orderBy('id', 'desc')->paginate(7);
        $count = Article::count();
        $article = Article::all();

           return view('bbs.board')
            ->with('pageMsgs',$pageMsgs)
            ->with('page',$page)
            ->with('count', $count)
            ->with('article', $article);
    }

    public function destroy(Request $request){
        $id = $request->id;
        $page = $request->page;

        \Log::debug('destory', ['id'=>$id]);

        Article::find($id)->delete();
        alert()->success('정상적으로 삭제되었습니다', '글 삭제');
        return redirect('board?page='.$page);
    }

    public function create(){
        return view('bbs.write_form');
    }

    public function store(Request $request){
        $title = $request->title;
        $writer = $request->writer;
        $content = $request->content;
        $tags = $request->tags;

        $this->validate($request, [
            'tags' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);

        $input = $request->all();
    	$tags = explode(",", $request->tags);

        alert()->success('정상적으로 등록되었습니다', '글 등록');

    	$article = Article::create($input);
    	$article->tag($tags);
        
        return redirect('board');
   }

    public function edit(Request $request){
        $id = $request->id;
        \Log::debug('edit', ['id'=>$id]);
        $member = Article::find($id);
        
        return view('bbs.update_form')
        ->with('id',$id)
        ->with('member',$member);
    }

    public function update(Request $request){
        $title = $request->title;
        $content = $request->content;
        $writer = $request->writer;
        $id = $request->id;
        
         alert()->success('정상적으로 수정되었습니다', '글 수정');
         $b = Article::find($id);
         $b->update($request->all());

         return redirect('board');
    }

    public function tagCategory(Request $request){ 
        $name = $request->name;
        $page = $request->page;
        $article = Article::withAnyTag($name)->paginate(7);
        
        return view('bbs.tag_category',compact('article'))
            ->with('name', $name)
            ->with('page', $page); 
    } 

    public function good(Request $request){
        $id = $request->id;
        $good = $request->good;

        $articles = Article::find($id);
        $articles->update(['good'=>$articles->$good+1]);
        return view('view',compact('article'));
        
    }

    public function search(Request $request){
        $searchValue = DB::table('articles')->select('title','content')->get();

        $q = $request->q;
        $page = $request->page;
        $count = Article::count();
        
        $pageMsgs = Article::where('content', 'LIKE', '%'.$q.'%')->orwhere('title', 'LIKE', '%'.$q.'%')->paginate(7);
        if(count($pageMsgs) > 0 || $q == $pageMsgs){
            return view('bbs.board')->withDetails($pageMsgs)->withQuery($q)
            ->with('pageMsgs',$pageMsgs)
            ->with('count', $count)
            ->with('searchValue', $searchValue)
            ->with('page', $page);
        }else {
            //alert()->info('검색한 키워드가 없습니다', '검색');
            return back();
            //여기에 검색한 키워드가 없습니다 라는 경고창 나오게 하기
        }
    }

    public function myAricles(Request $request){
        $user = Auth::user()->name;
        $count = Article::count();
        $pageMsgs = Article::where('writer', $user)->paginate(7);
        if($pageMsgs->count() > 0){
            $pageMsgs = Article::where('writer', $user)->paginate(7);
        }else{
            alert()->info('작성한 글이 없습니다', '마이페이지');
            return back();
        }
        return view('bbs.board')
        ->with('pageMsgs', $pageMsgs)
        ->with('page', $request->page)
        ->with('count', $count);
    }
}
