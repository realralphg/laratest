<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // R E G I S T E R 
    public function register(Request $request){
        $validator = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        
        $user = User::where('email', $request->get('email'))->first();

        if ($user) {
            return response()->json([
                'status' => 'exist',
                'message' => 'User already exist. please login',
            ], 409);
        } elseif (!$validator) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Registration Credentials, Review and Try Again.'
            ], 406);
        } else {
            $input = $request->all();
            $input['password'] = Hash::make($request->get('password'));

            $user = User::create($input);
            
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'access_token' => $tokenResult->accessToken,
                'user' => $user
            ]);
        }    
    }



    // L O G I N
    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if(!Auth::attempt($login)){
            return response(['message' => 'Invalid Login Credentials']);
        }

        $user = Auth::user();

        $accessToken = $user->createToken('Personal Access Token');
        $token = $accessToken->token;       
        $token->save();
        return response(['user'=>$user, 'token'=>$token]);
        
    }


    // L O G O U T
    public function logout(Request $request)
    {
        //$user = Auth::user();
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out'
        ]);
    }    
}
