<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


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
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //public function username()
    //{
     //   return 'username';
    //}

    public function getLogin()
    {
        return view('auth/login');
    }

    public function postLogin(Request $request)
    {
        //request
        $request_array = $request->all();

        // Kiểm tra dữ liệu nhập vào
        $rules = [
            'username' =>'required|string',
            'password' => 'required|min:6'
        ];

        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ];

        $validator = Validator::make($request_array, $rules, $messages);

        if ($validator->fails())
        {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('login')->withErrors($validator)->withInput();
        }
        else
            {
            // Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
            $username = $request['username'];
            $password = $request['password'];

            if( Auth::attempt(['username' => $username, 'password' =>$password]))
            {
                // Kiểm tra đúng email và mật khẩu sẽ chuyển trang
                //la admin
                if (Auth::user()->status)
                {
                    return redirect('homeadmin');
                }
                else
                {
                    return redirect('home');
                }

            }
            else
                {
                // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
                Session::flash('error', 'Username hoặc mật khẩu không đúng!');

                return redirect('login');
            }
        }
    }
}
