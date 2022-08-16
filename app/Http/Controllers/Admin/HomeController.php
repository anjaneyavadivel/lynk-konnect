<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $user_id = Auth::user()->id;
        $user_info = User::where('id', $user_id)->first(); 
        return view('admin/profile',compact('user_info'));
    }

    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_info = User::where('id', $user_id)->first(); 
        $user_info->fname=$request->fname;
        $user_info->lname=$request->lname;
        $user_info->email=$request->email;
        if($request->password)
        {
            $user_info->password=$request->password;
        }
        $user_info->save();
        return redirect('profile')->withFlashSuccess('Profile Updated successfully');
    }
}
