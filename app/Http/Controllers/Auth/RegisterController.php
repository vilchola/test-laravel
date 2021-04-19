<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email', 'max:250', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[0-9]/', 'regex:/[A-Z]/', 'regex:/[@$!%*#?&.]/'],
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['string', 'max:10', 'regex:/[0-9]/'],
            'document' => ['required', 'string', 'max:11'],
            'birthdate' => ['required', 'date', 'before_or_equal:-18 years'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'document' => $data['document'],
            'birthdate' => $data['birthdate'],
        ]);
    }
}