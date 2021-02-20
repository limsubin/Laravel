<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//user (=import)

use App\Myboard;

class BBSController extends Controller
{
    public function index(Request $request){

        //$page = requestValue("page");//현재 페이지
        $page = $request->page;
        
         if($page < 1)//값이 없으면 false로 본다
             $page = 1;
        //$dao = new BoardDao();
        $startRecord = ($page-1)*10;
        
        //$pageMsgs = $dao->getPageMsgs($page, 10);//10 : 한페이지에 몇개를 보여줄지
        $pageMsgs = Myboard::orderBy('Num', 'desc')->skip($startRecord)->take(10)->get();//정렬, 건너뛰고, 10개 가지고옴

        $numPageLinks = 10;
        $numMsgs = 10;
        $startPage= floor(($page-1)/$numPageLinks)*$numPageLinks+1;//한페이지에 출력할 페이지 링크의 수
        
        //$count = $dao->getTotalCount();
        $count = Myboard::count();

        $endPage = $startPage + ($numPageLinks-1);
        $totalPages = ceil($count/$numMsgs);
        
         return view('bbs.board')
        ->with('page',$page)
        ->with('startRecord',$startRecord)
        ->with('pageMsgs',$pageMsgs)
        ->with('numPageLinks',$numPageLinks)
        ->with('numMsgs', $numMsgs)
        ->with('startPage', $startPage)
        ->with('endPage',$endPage)
        ->with('totalPages', $totalPages);
    }
    
   public function create(){
       return view('bbs.write_form');
   }
    
   public function store(Request $request){
        //$title = requestValue('title');
        //$writer = requestValue('writer');
        //$content = requestValue('content');
        $title = $request->title;
        $writer = $request->writer;
        $content = $request->content;

       // if($title && $writer && $content){
            //DB에 insert
            //$dao = new BoardDao();
            //$dao->insertMsg($title, $writer, $content);
            Myboard::create(['Title'=>$title, 'Writer'=>$writer, 'Content'=>$content]);

            //okGo("정상적으로 입력되었습니다", "bbs");
            return redirect('bbs')->with('message','새로운 글이 정상적으로 입력되었습니다');
       // }else{
           // errorBack("모든 항목이 빈칸 없이 입력되어야 합니다");
       // }
   }

   public function show(Request $request){
        
       // $num = requestValue("num");
       $num = $request->num;
       $Hits = $request->hits;
       // $dao = new BoardDao();
       // $dao->increaseHits($num);
       // $msg = $dao->getMsg($num);
        $msg = Myboard::find($num);
        $msg->update(['Hits'=>$msg->$Hits+1]);//Hits를 모델에 Myboard에 $fillable에 무조건 칼럼 추가해주어야한다

       // $page = requestValue("page");
       $page = $request->page;

        return view('bbs.view')
        ->with('msg',$msg)
        ->with('page',$page);
   }

   public function update(Request $request){
       //$content = requestValue("content");
       // $title = requestValue("title");
       // $num = requestValue("num");
       // $writer = requestValue("writer");
       $content = $request->content;
       $title = $request->title;
       $num = $request->num;
       $writer = $request->writer;

        //if($content && $title && $writer){
           // $dao = new BoardDao();
           //$dao->updateMsg($num, $title, $writer, $content);
            $b = MyBoard::find($num);
            $b->update(['Title'=>$title, 'Writer'=>$writer, 'Content'=>$content]);

           /* $b = new Myboard();
            $b.updateMsg($num, $title, $writer, $content);*/

           
            return redirect('bbs')
            ->with('message','게시글이 수정되었습니다');
            
       // }else{
           // errorBack("모든 항목이 빈칸없이 입력되어야 합니다");
      //  }
   }

   public function edit(Request $request){
        
        //$page = requestValue("page");
        //$num = requestValue("num");
        $page = $request->page;
        $num = $request->num;

        // $dao = new BoardDao();
        // $dao->increaseHits($num);
        // $msg = $dao->getMsg($num);
        $msg = Myboard::find($num);


        return view('bbs.modify_form')
        ->with('num', $num)
        ->with('page', $page)
        ->with('msg',$msg);
   }

   public function destroy(Request $request){
        
        //$num = requestValue("num");
        //$page = requestValue("page");
        $num = $request->num;
        $page = $request->page;

        //$dao = new BoardDao();
        //$dao->deleteMsg($num);
        Myboard::find($num)->delete();

        //okGo("게시글이 삭제되었습니다",  "bbs?page=$page");
        return redirect('bbs?page=$page');
   }
   
}
