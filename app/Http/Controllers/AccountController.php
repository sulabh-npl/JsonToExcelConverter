<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function logout(Request $request)
    {
        try{
            auth()->logout();

            return redirect()->route('login')->with('success', 'You have been logged out.');

        }catch(\Exception $e){

            return redirect()->back()->with('error', 'An error occurred while logging out.');
        }
    }
}
