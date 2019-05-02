<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use JWTAuth;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }
}
