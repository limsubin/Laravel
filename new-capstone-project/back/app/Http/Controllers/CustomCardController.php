<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customcard;
// use App\Board;
// use Illuminate\Support\Facades\Auth;
// use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customcard =  DB::select("select
                     c.id,
                     c.customcard_name,
                     c.user_id,

                     p.product_code AS 'positive_perfume',
                     p.aroma_name AS 'positive_perfume_name' ,
                     p.product_color AS 'positive_color_name',
                     c.positive_strength,

                     n1.product_code AS 'normal_perfume',
                     n1.aroma_name AS 'normal_perfume_name',
                     n1.product_color AS 'normal_color_name',
                     c.normal_strength,

                     n2.product_code AS 'nagative_perfume',
                     n2.aroma_name AS 'nagative_perfume_name',
                     n2.product_color AS 'nagative_color_name',
                     c.nagative_strength, c.rgb,
                             c.bright, c.indate
                             from customcard c JOIN product p
                             ON(c.positive_perfume = p.product_code)
                             JOIN product n1
                             ON(c.normal_perfume = n1.product_code)
                             JOIN product n2
                             ON(c.nagative_perfume = n2.product_code);");

        $data = Customcard::orderBy('indate', 'desc')->get(['rgb']);
        $count = count($data);
        $data2 = $data[0]['rgb'];
        $count2 = count(explode(",",$data2));
        $st = "[";

        for($i=0 ; $i<$count ; $i++){
            if($i != 0 ){
                $st .= ",";
            }
            $data2 = $data[$i]['rgb'];
            $count2 = count(explode(",",$data2));
            if($data2 != "0.0.0"){
                $st .= "\"";
                for($j=0 ; $j<$count2 ; $j++){
                    $split = str_replace(".",",",explode(",",$data2)[$j]);
                    if($j == 0){
                        $st .= "rgb(".$split.")";
                    }else{
                        $st .= ",rgb(".$split.")";
                    }
                }
                if($data2 != "0.0.0"){
                    $split = str_replace(".",",",explode(",",$data[$i]['rgb'])[0]);
                    $st .= ",rgb(".$split.")\"";
                }
            }else{
                $st .= "\"rgb()\"";
            }

        }
        $st .= "]";
        $st = json_decode($st);
        \Log::info($st);
        //return $st[0];
        //return response()->json(['customcard' => $customcard, 'rgb' => $st]);
        return response()->json(['customcard'=>$customcard,'rgb'=>$st]);
        //return Customcard::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->content??"")
        {   
            // 커스텀 카드가 있는 경우입니다.
            // 1. 게시글 등록

            DB::table('board')->insert([
            // 'id'=>'shinhyeonbin',
            'title'=>'게시글 제목입니다.',
            'content'=>$request->content,
            'indate'=>date('Y-m-d')
            ]);

            //$sub=DB::table('board')->where('id','shinhyeonbin')->orderByRaw('num DESC')->value('num'); // 게시글을 등록한 사용자의 it에서 최근 게시글 num을 불러와 저장하는 변수입니다.

            // 2. 커스텀 카드 등록록
            DB::table('customcard_board')->insert(
            [
                'num' => 13,//$sub,
                'customcard_name' => $request->customcard_name,
                'user_id' => "ShinHyeonBin@gmail.com",
                'positive_perfume' => $request->positive_perfume,
                'positive_strength' => $request->positive_strength,
                'normal_perfume' => $request->normal_perfume,
                'normal_strength' => $request->normal_strength,
                'nagative_perfume' => $request->normal_perfume,
                'nagative_strength' => $request->nagative_strength,
                'rgb' => $request->rgb,
                'bright' => $request->bright
            ]);
            //return $sub;
        } else { // 커스텀 카드 이름이 안 넘어올 경우입니다.
            echo '엘세가 실행됨';
            DB::table('board')->insert([
                // 'id'=>'shinhyeonbin',
                'title'=>'게시글 제목입니다.',
                'content'=>$request->content,
                'indate' => date('Y-m-d')
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
