<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //제품 전체 페이지
    public function index()
    {
        return response()->json(Product::all(),200);
    }
    
    //제품 레코드 만듬
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'units' => $request->units,
            'price' => $request->price,
            'image' => $request->image
        ]);
        
        return response()->json([
            'status' => (bool) $product,
            'data'   => $product,
            'message' => $product ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    //하나의 제품을 반환(제품 상세페이지)
    public function show(Product $product)
    {
        return response()->json($product,200); 
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile('image')){
            $name = time()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
        }
        return response()->json(asset("images/$name"),201);
    }

    //제품 레코드를 업데이트 
    public function update(Request $request, Product $product)
    {
        $status = $product->update(
            $request->only(['name', 'description', 'units', 'price', 'image'])
        );
        
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    //제품을 삭제 
    public function updateUnits(Request $request, Product $product)
    {
        $product->units = $product->units + $request->get('units');
        $status = $product->save();
        
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Units Added!' : 'Error Adding Product Units'
        ]);
    }
    
    //제품의 이미지를 업로드, 제품의 URL을 반환
    public function destroy(Product $product)
    {
        $status = $product->delete();
        
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
