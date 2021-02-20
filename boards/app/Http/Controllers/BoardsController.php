<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use Auth;

class BoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
         $this->middleware('auth');
         $this->middleware('own')->only(['update', 'destory']);
        // $this->middleware('owner');
     }

    public function index(Request $request)
    {
        $page = $request->page;
        $msgs = Board::orderBy('created_at', 'desc')->paginate(10);
        return view('bbs.index', ['page'=>1])
            ->with('msgs', $msgs)
            ->with('page', $page);
       // __METHOD__;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('bbs.write_form');
        // __METHOD__;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1. 사용자 입력한 게시글 정보를 boards테이브에 insert(title, content)
        // $user = Auth::user();
        // DB::insert('insert into boards(title, content, user_id) values(?,?,?,[$resut->title, $request->content, $user->id])')
        // return;

        $user = Auth::user();
        Board::create(['title'=>$request->title, 'user_id'=>$user->id, 'content'=>$request->content]);
        return redirect(route('boards.index'));
        //__METHOD__;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $page = $request->page;
        $board = Board::find($id);
        $board->hits++;
        $board->save();
        return view('bbs.show')
                ->with('board', $board)
                ->with('page', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $page = $request->page;
        $b = Board::find($id);
        return view('bbs.edit')
                ->with('board', $b)
                ->with('page', $page);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required'
            ]);
            //수정하고자 하는 글이 로그인한 사용자의 글인지 체크 
            //그렇지 않으면 back()
            //그렇지 않으면 아래로..
       $page = $request->page;
       $b = Board::find($id);
       $b->title = $request->title;
       $b->content = $request->content;
       $b->save();
       return redirect(route('boards.index',['page'=>$request->page]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //수정하고자 하는 글이 로그인한 사용자의 글인지 체크 
        //그렇지 않으면 back()
        //그렇지 않으면 아래로..
        //DB에서 $id에 해당하는 게시글을 읽어온다
        //읽어온 그 글에 대해 삭제 요청한다

        $b = Board::find($id);
        $b->delete();
        return redirect(route('boards.index'));
    }


    //나중에 수정하기
    public function myAricles(Request $request){
        //$msgs = Auth::user()->boards;
        $msgs = Board::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('bbs.index')->with('msgs', $msgs)
        ->with('page', $request->page);
    }
}
