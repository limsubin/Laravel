<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'items' => \Cart::content(), // カートの中身
            'subtotal' => \Cart::subtotal(), // 全体の小計
            'tax' => \Cart::tax(), // 全体の税
            'total' => \Cart::total() // 全合計
        ];
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
    public function store(Request $request)//아마 여기가 문제
    {
        //$userId = Auth::id();
        $product = \App\Product::find($request->product_code);//클라이언트에서 proudct_id라고 지정해서 이렇게 날아오는거임
        //\Log::info($product);
        // \Cart::add(
        //     $product->product_code,
        //     $product->aroma_name,
        //     '1',
        //     $product->product_price,
        //     array()
        // );
        
        // \Log::info(\Cart::content());
        // return \Cart::content();//return하는 곳에서 잘못?

        //2
        //  $cart = session()->get('cart');

        // // 카트가 비어 있으면 첫 번째 제품
        // if(!$cart) {
        //     $cart = [
        //             $id = [
        //                 "name" => $product->aroma_name,
        //                 "quantity" => 1,
        //                 "price" => $product->product_price,
        //                 "첫번째 상품"
        //             ]
        //     ];
 
        //     session()->push('cart', $cart);
 
        //     return session()->all();
        // }
 
        // // 카트가 비어 있지 않으면 제품이 존재하는지 확인한 다음 증분 수량
        // if(isset($cart[$id])) {
 
        //     $cart[$id]['quantity']++;
 
        //     session()->push('cart', $cart);
 
        //     return session()->all();
 
        // }
 
        // // 항목이 카트에 없으면 수량 = 1의 카트에 추가합니다
        // $cart[$id] = [
        //     "name" => $product->aroma_name,
        //     "quantity" => 1,
        //     "price" => $product->product_price
        // ];
 
        // session()->push('cart', $cart);
 
        // return session()->all();

        //3
        $cart = Session::get('cart');
        $cart[] = array(
            "id" => $product->product_code,
            "nama_product" => $product->aroma_name,
            "harga" => 1,
            "pict" => $product->product_price,
            "qty" => 1,
        );
        
        Session::put('cart', $cart);
        Session::flash('success','barang berhasil ditambah ke keranjang!');

        //return Session::get('cart');
        return ['cart'=>1, 'item'=>'test'];
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
