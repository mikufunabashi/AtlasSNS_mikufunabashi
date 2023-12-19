<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        return view('users.search');
    }

    // ログイン機能？
    public function users()
    {
        // ここに何か記入が必要な気がします！
        return view('posts.index');
    }
}
