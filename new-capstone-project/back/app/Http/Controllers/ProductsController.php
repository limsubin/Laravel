<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //모든 상품 반환
   public function index(){
        // $product = \DB::select("select o.product_code, p.product_name, p.product_img, p.product_price, p.indate
        // FROM product p JOIN (SELECT product_code 
        // FROM orders
        // GROUP BY product_code 
        // ORDER BY SUM(quantity) DESC
        // ) o
        // ON p.product_code = o.product_code
        // LIMIT 5");

        // return response()->json($product);
       return Product::orderBy('indate', 'desc')->get();
   }

   //상품 등록
   public function store(Request $request){
       $exploded = explode(',', $request->image);
       $decoded = base64_decode($exploded[1]);
       if(str_contains($exploded[0], 'jpeg')){
           $extension = 'jpg';
       }else{
           $extension = 'png';
       }
       //\Log::info($request->all());
       $fileName = str_random().'.'.$extension;
       $path = public_path().'/'.$fileName;
       file_put_contents($path, $decoded);

       $product = Product::create($request->except('image') + [
           'user_id' => Auth::id(),
           'image' => $fileName
        ]);

       return $product;
   }

   //상품 수정할 때 상품 내용 가져옴
   public function show($id){
       $product = Product::find($id);

       //if(count($product) > 0){
          return response()->json($product);  
       //}
          
       //return response()->json(['error'=>'Resource not found!'], 404);
   }

   public function update(Request $request, $id){
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json($product);
   }

   public function destroy($id){
        try{
            Product::destroy($id);
            return response([], 204);
        }catch(\Exception $e){
            return response(['Problem deleting the p
            roduct', 500]);
        }
   }

   public function login(Request $request)
    {
        //$request->email로 해서 못 받아옴
        //if(Auth::attempt(array('email' => 'SeoBoMin@gmail.com', 'password' => 'password'))){
            return response()
                ->json([
                    'user' => Auth::user(),
                    'authenticated' => true,
                ]);
       // }
    }
}
