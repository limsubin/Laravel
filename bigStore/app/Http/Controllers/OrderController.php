<?php

namespace App\Http\Controllers;

use App\Order;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //모든 주문내역 
    public function index()
    {
        return response()->json(Order::with(['product'])->get(), 200);
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
    
    //주문을 만듭니다
    public function store(Request $request)
    {
        $order = Order::create([
            'product_id'=>$request->product_id,
            'user_id'=>Auth::id(),
            'quantity'=> $request->quantity,
            'address'=>$request->adddress
        ]);

        return response()->json([
            'status' => (bool)$order,
            'data'=>$order,
            'message'=>$order ? 'Order Created!' : 'Error Creating Order'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */

    //단일 주문을 가져와서 반환 
    public function show(Order $order)
    {
        return response()->json($order, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */

    //주문을 업데이트 
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */

    //주문을 삭제 
    public function destroy(Order $order)
    {
        $status = $order->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Order Updated!' : 'Error Deleting Order'
        ]);
    }

    //배달된 주문 표시
    public function deliverOrder(Order $order){
        $order->is_delivered = true;
        $status = $order->save();

        return response()->json([
            'status' => $status,
            'data' => $order,
            'message' => $status ? 'Order Delivered!' : 'Error Delivering Order'
        ]);
    }
}
