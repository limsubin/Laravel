<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //제품 전체 페이지
    public function index()
    {
        return response()->json(Product::all(), 200);
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

    //제품 레코드 만듬
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description'=>$request->description,
            'units'=> $request->units,
            'price'=>$request->price,
            'image'=>$request->image
        ]);

        return reqponse()->json([
            'status' =>(bool)$product,
            'data'=>$product,
            'message'=>$product ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    //하나의 제품을 반환(하나의 제품의 상세페이지)
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    //제품 레코드를 업데이트 
    public function update(Request $request, Product $product)
    {
        $status = $product->update(
            $request->only(['name','description','units','price','image'])
        );

        return response()->json([
            'status'=>$status,
            'message'=>$status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    //제품을 삭제 
    public function destroy(Product $product)
    {
        $status = $product->delete();

        return response()->json([
            'status'=> $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }

    //제품의 이미지를 업로드, 제품의 URL을 반환
    public function uploadFile(Request $request){
        //이미지 업로드
        if($request->hasFile('image')){
            $name = time()."_".$request->file('image')->getClientOriginalName();
            $request-file('image')->move(public_path('images'), $name);
        }
        return response()->json(asset("images/$name"), 201);
    }

    //제품에 새 단위를 추가
    public function updateUnits(Request $requset, Product $product){
        $product->units = $product->units + $request->get('units');
        $status = $product->save();

        return response()->json([
            'status'=> $status,
            'message'=> $status ? 'Units Added' : 'Error Adding Product Units'
        ]);
    }
}
