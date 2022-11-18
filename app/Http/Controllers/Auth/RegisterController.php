<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Countries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'pic_name'  => ['nullable', 'string', 'max:255'],
            'username'  => ['nullable', 'string', 'max:255'],
            'pic_email'  => ['nullable', 'string', 'max:255'],
            'pic_phone_number' => ['nullable', 'string', 'max:255'],
            'country_id' => ['nullable', 'integer'],
            'email' => ['nullable', 'string', 'max:255'],
            'institution_name' => ['nullable', 'string', 'max:255'],
            'institution_email' => ['nullable', 'string', 'max:255'],
            'institution_type' => ['nullable', 'string', 'max:255'],
            'institution_logo' => ['nullable', 'string', 'max:255'],
          
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected  function index(){
    
        return view('auth.register',[
            "countries" => Countries::all()
        ]);
    }
    protected function create(array $data){
       $username = strtolower(str_replace(' ', '', $data['name']));
        return User::create([
            'created_by' => $username,
            'institution_name' => $data['ins_name'],
            'institution_email' => $data['ins_email'],
            'institution_type' => $data['ins_type'],
            'institution_logo' => 'logo.png',
            'pic_name' => $data['name'],
            'username' => $username,
            'email' =>  $data['email'],
            'pic_phone_number' => $data['phone'],
            'password' => Hash::make($data['password']),
            'country_id' => $data['country_id'],
        ]);

        return redirect()->route('/');
    }
}
