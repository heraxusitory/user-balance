<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([], Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();

        return response()->json($user, Response::HTTP_OK);

    }
}
