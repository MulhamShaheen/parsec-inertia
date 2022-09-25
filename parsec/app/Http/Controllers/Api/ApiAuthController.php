<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Hash;
use Session;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function index(Request $request){

        $credentials = $request->only('email', 'password');
        if ($user = User::where('email', $request->email)
            ->where('password', $request->password)
            ->first()
            ) {
            Auth::login($user);
            $token = $user->tokenCreator();
            return response()->json([
                'status' => 'success',
                'content' => [
                    'token' => $token,
                    'user' => $user,
                ],

            ]);
        }

        return response()->json([
            'status' => 'something went wrong',
            'error_list' => [
                $errors ?? "unveiled username or password"
            ],
            'debug'=>Auth::attempt($credentials,false)

        ]);

    }
    public function registration(Request $request){

        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if($user){
            return response()->json([
                'status' => 'success',
                'message' => 'user is successfully created',
            ]);
        }

        return response()->json([
            'status' => 'something went wrong',
            'error_list' => [
                $errors ?? "unveiled username or password"
            ],

        ]);
    }

    public function test(Request $request){
//        print_r($request);
        return $request;

    }
}
