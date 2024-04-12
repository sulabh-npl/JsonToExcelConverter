<?php

namespace App\Http\Controllers\PreLogin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception, DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        if(Auth::check()){

            return redirect()->route('home')->with('error', 'You are already logged in')->send();
        }
    }
    public function login()
    {
        return view('auth.login');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        try{

            $github_user = Socialite::driver('github')->stateless()->user();

            throw_if(!$github_user, Exception::class, 'User not found');

            DB::beginTransaction();

            $user = User::firstOrCreate([
                'email' => $github_user->email ?? $github_user->nickname."@github.com"
            ], [
                'name' => $github_user->name,
                'password' => bcrypt(Str::random(24)),
                'github_id' => $github_user->id
            ]);

            DB::commit();

            Auth::login($user->refresh());

            if(Auth::check()){

                return redirect()->route('home')->with('success', 'Logged in successfully');
            }

            return redirect()->route('login')->with('error', 'Unable to login');

        }catch(Exception $e){

            DB::rollBack();

            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }
}
