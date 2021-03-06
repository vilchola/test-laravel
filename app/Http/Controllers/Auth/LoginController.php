<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required', 'string'],
    //     ]);

    //     $credentials = request(['email', 'password']);

    //     if (!Auth::attempt($credentials))
    //         return response()->json(['message' => 'Unauthorized'], 401);

    //     $user = $request->user();
    //     $tokenResult = $user->createToken('Laravel Personal Grant Client');
    //     $token = $tokenResult->token;
    //     $token->save();

    //     return response()->json([
    //         'access_token' => $tokenResult->accessToken,
    //         'token_type' => 'Bearer',
    //         'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
    //     ]);
    // }

    // public function logout(Request $request) {
    //     Auth::logout();
    //     return response()->json(['message' => 'Successfully logged out']);
    // }
}
