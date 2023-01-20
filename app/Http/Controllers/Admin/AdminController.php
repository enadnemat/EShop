<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Brand;
use App\Models\User\Category;
use App\Models\User\Color;
use App\Models\User\Offer;
use App\Models\User\Order;
use App\Models\User\Product;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Session;


class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        $product = Product::count();
        $category = Category::count();
        $brand = Brand::count();
        $color = Color::count();
        $offer =Offer::count();
        $order = Order::count();


        return view('admin.index', compact('product', 'category', 'brand', 'color','offer','order'));
    }

    public function template()
    {
        return view('admin.layouts.template');
    }

    protected function authenticated()
    {
        if (Auth::check()) {
            return redirect()->route('admin.index');
        }
    }

    // get login page
    public function loginPage()
    {
         //dd(Auth::check());
        return view('admin.auth.adminLogin');
    }

    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required | email',
            'password' => 'required'
        ]);

        // return $request->all();
        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {

            return redirect()->route('admin.index');
        }
        return back()->with('error','Invalid Credential');

    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * @throws ValidationException
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return Redirect()->route('admin.login');
    }

}
