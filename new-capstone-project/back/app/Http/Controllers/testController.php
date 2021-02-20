<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Customcard;
//use App\Http\Controllers\Date;

use App\Order;
use App\User;
use App\Product;

class testController extends Controller
{
    public function index(Request $request){
        $start_date = '2019-03-17 15:00:00';//현재시간 적기,date("Y-m-d h:i:s")
        $end_date = '2019-03-18 15:00:00';//현재시간에서 +4시간
        $arr = array();
        $sum_arr = array();
       
        for($i=1; $i<5; $i++){
            $end_date = date("Y-m-d H:i:s", strtotime($start_date." +1 days"));//+1 month,+1 year,+4 hours
            //$test = \DB::select("select sum(value) from emotion_value where check_time BETWEEN '$start_date' AND '$end_date'");
            $test = \DB::table('emotion_value')
                ->select(\DB::raw('sum(value)'))
                ->whereBetween('check_time',[$start_date, $end_date])
                ->get();
            $arr[$i] = json_decode($test, true);
            foreach($arr[$i] as $j => $v){
              $arr[$i] = $v["sum(value)"];
            }
            //$sum = array_sum($test[1]['value']);
            //$arr[$i] = $test;
            $start_date = $end_date;
        }

        return $arr;
    }

    // 커스텀 카드 저장
    public function store(Request $request){
        $customcard = Customcard::create([
            'positive_strength' => $request->positive_strength,
            'normal_strength' => $request->normal_strength,
            'nagative_strength' => $request->nagative_strength,
            'rgb' => $request->rgb,
            'opacity'=> $request->opacity
        ]);
        \Log::info($request->opacity);
        
        return response()->json($customcard);
    }

    //select box에 성별로 정렬하는 부분
    public function woman(){
        return \DB::select("select o.product_code, o.order_code, p.product_name, p.product_img, p.product_price, SUM(o.quantity) AS 'quantity' from orders o JOIN member m JOIN product p
        on(o.id = m.id)
        where substr(m.resident_number,-1) = '1'
        GROUP BY product_code
        order by SUM(o.quantity) DESC
        LIMIT 4;");
    }

    //select box에 성별로 정렬하는 부분
    public function man(){
        return \DB::select("select o.product_code,  p.product_name, p.product_img, p.product_price, SUM(o.quantity)
        AS 'quantity' from orders o JOIN member m JOIN product p
       on(o.id = m.id)
       where substr(m.resident_number,-1) = '1'
       GROUP BY product_code
       order by SUM(o.quantity) DESC
       LIMIT 4;");
    }

    public function showorders(Order $user){
        $order = Order::find($user);
        //$order = \DB::table('orders')->where('id', $user);
        //$product = Product::find($order->product_code);
        //return 'order';
        return 'test';
    }
}
