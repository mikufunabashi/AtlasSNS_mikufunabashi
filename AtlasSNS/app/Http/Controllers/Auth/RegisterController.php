<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            // 全てのデータが対象になる↓
            $date = $request->all();
            $validatedData = $request->validate([
                'username' => 'required|max:12|min:2',
                'mail' => 'required|max:40|min:5|email|unique:users,mail',
                'password' => 'required|max:20|min:8|alpha_num|confirmed:password',
                'password_confirmation' => 'required|max:20|min:8|alpha_num',
            ]);
            // ＊エラーメッセージ日本語表示できないなぜ、jaファイル作ったのに、、、

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            // セッションを使用したユーザー名の表示
            // セッションへデータを保存する記述
            $request->session()->put('username',$username);
            // セッションに保存したデータを、＊表示する記述　withの後の説明求む
            return redirect('added')->with('username',$username);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}


//  public function messages()
//     {
//         return [
//           'user_name.required' => 'ユーザー名は必須です。',
//           'email.required'     => 'メールアドレスは必須です。',
//           'email.unique'       => 'メールアドレスはすでに使用されています。',
//         ];
//     }
