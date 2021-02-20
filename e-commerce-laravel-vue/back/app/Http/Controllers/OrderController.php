<?php

namespace App\Http\Controllers;

use App\Order;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //모든 주문내역
    public function index()
    {
        return response()->json(Order::with(['product'])->get(),200);
    }
    
    //주문을 만듭니다
    public function deliverOrder(Order $order)
    {
        $order->is_delivered = true;
        $status = $order->save();
        
        return response()->json([
            'status'    => $status,
            'data'      => $order,
            'message'   => $status ? 'Order Delivered!' : 'Error Delivering Order'
        ]);
    }
    
    //단일 주문을 가져와서 반환
    public function store(Request $request)
    {
        Log::debug("controller 들어옴"+$request);
        $order = Order::create([
            'product_id' => $request->product,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'address' => $request->address
        ]);
        
        return response()->json([
            'status' => (bool) $order,
            'data'   => $order,
            'message' => $order ? 'Order Created!' : 'Error Creating Order'
        ]);
    }

    //주문을 업데이트
    public function show(Order $order)
    {
        return response()->json($order,200);
    }
    
    //배달된 주문 표시
    public function update(Request $request, Order $order)
    {
        $status = $order->update(
            $request->only(['quantity'])
        );
        
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Order Updated!' : 'Error Updating Order'
        ]);
    }

    //주문을 삭제
    public function destroy(Order $order)
    {
        $status = $order->delete();
        
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Order Deleted!' : 'Error Deleting Order'
        ]);
    }
}