<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //주문한 모든 사용자를 반환
    public function index(){
        return response()->json(User::with(['orders'])->get(), 200);
    }

    //사용자를 인증, 해당 사용자에 대한 액세스 토큰 생성
    //createToken : Laravel Passport가 사용자 모델에 추가하는 방법 중 하나
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        //Log::debug('cotroller넘어옴, 값전달:'+$credentials);
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        //수동으로 사용자 인증
        if (Auth::attempt($credentials)) {
            $status = 200;
            $response = [
                //User모델 인스턴스 의 메소드를 사용하여 주어진 사용자에 대한 토큰을 발행
                'token' => Auth::user()->createToken('bigStore')->accessToken,
                'user' => Auth::user()
            ];
        }
        
        return response()->json($response, $status);
    }

    //회원가입, 인증하고, 액세스 토큰을 생성
    public function register(Request $request)
    {
        //Validator : 라라벨의 베이스 컨트롤러 클래스는 다양하고 강력한 유효성 검사 규칙을
        //적용하여 편리하게 HTTP 요청을 승인하는 메소드를 제공
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        //fails() : 유효성 검사가 실패할 때
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);//암호화

        //사용자 생성(name, email, password)
        $user = User::create($input);

        $success = [
            'user' => $user,
            'token' => $user->createToken('bigStore')->accessToken,
        ];
        
        return response()->json($success);
    }
    
    //사용자 상세 페이지
    public function show(User $user)
    {
        return response()->json($user,200);
    }
    
    //사용자 전체주문 페이지
    public function showOrders(User $user)
    {
        // return response()->json($user->orders()->with(['product'])->get(),200);
        return '{[]}'
    }
}