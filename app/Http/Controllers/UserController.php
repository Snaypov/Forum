<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        if($user){
            return response()->json($user);
        }
        return response()->json(['error'=>'User not found!'], 404);
    }

}
