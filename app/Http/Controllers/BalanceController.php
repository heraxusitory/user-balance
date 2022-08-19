<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return response()->json($user->balances);
    }
}
