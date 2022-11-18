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
            'institution_name' => ['required', 'string', 'unique:users'],
            'institution_type' => ['required', 'string'],
            'institution_logo' => ['image', 'required', 'max:1999', 'mimes:jpg,png,jpeg'],
            'pic_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'institution_email' => ['required', 'email'],
            'pic_phone_number' => ['required', 'numeric'],
            'country_id' => ['required', 'integer'],
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
        $username = $data['pic_name'];
        $pic = $data['institution_name'];
        $fileName = str_replace(' ', '-', $pic );
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        $current = time();

        if ($data['institution_logo']) {
            $extension = $data['institution_logo']->getClientOriginalExtension();
            $fixedName = $fileName.'_'.$current.'.'.$extension;
            $path = $data['institution_logo']->storeAs("public/instition_logo",$fixedName);
 
        }
        
        return User::create([
            'institution_name' => $data['institution_name'],
            'institution_email' => $data['institution_email'],
            'institution_type' => $data['institution_type'],
            'institution_logo' => $fixedName,
            'pic_name' => $data['pic_name'],
            'username' => $username,
            'email' =>  $data['email'],
            'pic_phone_number' => $data['pic_phone_number'],
            'password' => Hash::make($data['password']),
            'country_id' => $data['country_id'],
            'created_by' => $username,
        ]);

        return redirect()->route('/')->with('success','Account is successfully made');
    }
}
