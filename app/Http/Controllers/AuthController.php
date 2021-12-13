<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Mail\ConfirmAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
//    protected function generateAccessToken($user){
//        $token = $user->createToken($user->email.'-'.now());
//
//        return $token->accessToken;
//    }

    /**
     * Register user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRequest $authRequest): \Illuminate\Http\JsonResponse
    {
        $validator = $authRequest->validated();

//        dd($validator->fails());
//        if($validator->fails()) {
//            return response()->json($validator->errors(), 400);
//        }

        $user = User::create([
           'name' => $authRequest->name,
           'email' => $authRequest->email,
           'nickname' => $authRequest->nickname,
           'photo' => $authRequest->photo,
           'password' => Hash::make($authRequest->password),
        ]);

        Mail::to($user->email)->send(new ConfirmAuth($user->email));

        return response()->json([
            'message' => 'Please, check your email address to finish registration',
        ], 200);
    }

    public function confirmEmail($email){
        $user = User::where('email', $email)->first();

        if($user){
            User::where('email', $email)->update(['email_verified_at' => now()]);
            return response()->json([
                'message' => 'You successfully confirmed email address.'
            ], 201);
        }
    }

    public function login(LoginRequest $loginRequest): \Illuminate\Http\JsonResponse
    {
//        $validator = $loginRequest->validated();

//        if($validator->fails()){
//            return response()->json($validator->errors(), 422);
//        }

//        dd(User::where('email',$loginRequest->email));
//        $user = User::where('email', $loginRequest->email)->first();
//        dd($user);
        if(!User::where('email',$loginRequest->email)->where('email_verified_at', '!=', ' ')->first() &&
            Auth::attempt(['email' => $loginRequest->email, 'password' => $loginRequest->password])){

            $user = Auth::user();
            $token = $user->createToken($user->email.'-'.now());

            return response()->json([
               'token' => $token->accessToken
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
//
