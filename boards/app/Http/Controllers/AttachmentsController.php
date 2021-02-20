<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Attachment;
use App\Board;

class AttachmentsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
            1. 전송받은 파일을 지정된 폴더에 저장한다
                어느 폴더에 저장하나?
                public/files/사용자_아이디/

            2. 파일정보를 attachments테이블에 저장한다
            3. 잘 저장되었어요라는 결과를 클라이언트에게 송신한다
        */
        //$attachment = null;
        //\Log::debug('AttachmentsController store', ['stpe'=>1]);
        
    	if($request->hasFile('file')) {
        /****** 1번 구현 *****/
    		$file = $request->file('file');
 			
    		$filename = /*str_random().*/filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
    		$bytes = $file->getSize();
            $user = \Auth::user();
            $path = public_path('files').DIRECTORY_SEPARATOR.$user->id;
            //C:\Laravel\boards\public\files\3
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);//0777 : 리눅스권한
            }
            
    		$file->move($path, $filename);//(어느폴더로, 어떤 폴더로)
        /***********/

        /****** 2번 구현 *****/
    		$payload = [
    				'filename'=>$filename,
    				'bytes'=> $bytes,
    				'mime'=>$file->getClientMimeType()
    			];
    			
            $attachment =  Attachment::create($payload);
        /***********/
        }
        /****** 2번 구현 *****/
    	\Log::debug('AttachmentsController store', ['stpe'=>7]);
        return response()->json($attachment, 200);
        /***********/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $filename =  $request->filename;
        $attachment = Attachment::find($id);
        $attachment->deleteAttachedFile($filename);
        $attachment->delete();
        $user = \Auth::user();
        /*
        $path = public_path('files') . DIRECTORY_SEPARATOR .  $user->id . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        */
        return $filename;  
    }
}
