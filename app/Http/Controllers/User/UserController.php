<?php

namespace App\Http\Controllers\User;

use App\Models\User\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, AuthenticatesUsers;

    public function index()
    {
        return view('user.Auth.RegisterUser');
    }

    public function login()
    {
        //dd(Auth::guard('web')->check());
        return view('user.Auth.LoginUser');
    }

    public function create(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

       return redirect()->route('user.index');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required | email',
            'password' => 'required'
        ]);

       // dd($request->all());

        //$credentials = $request->only('email','password');
        // return $request->all();
        if (Auth::guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
//
            return redirect()->route('shop.category');
        }

        return back()->withInput($request->only('email'));

    }
    protected function guard()
    {
        return Auth::guard('web');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login');
    }

}
