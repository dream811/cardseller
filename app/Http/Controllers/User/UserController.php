<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\User;
use App\Models\CardSell;
use Yajra\DataTables\DataTables;

class UserController extends Controller
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
    public function guide(Request $request)
    {
        $title="";
        $guide = Setting::first()->guide;
        return view('user.guide', compact('title', 'guide'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mypage(Request $request)
    {
        $title="My Info";
        return view('user.mypage', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function check_password(Request $request)
    {
        if(Hash::check($request->post('password'), Auth::user()->password)){
            $message = "Password doesn't match with your old password.";
            return response()->json(["status" => "success", "data" => compact('message')]);
        }else{
            $message = "Password is incorrect.";
            return response()->json(["status" => "failed", "data" => compact('message')]);
        }
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function change_password(Request $request)
    {
        $new_password = Hash::make($request->post('password_new'));
        $user = User::find(Auth::id());
        $user->password = $new_password;
        $user->save();
        $message = "Your password changed successfully.";
        return response()->json(["status" => "success", "data" => compact('message')]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function change_info(Request $request)
    {
        $nickname = $request->post('nickname');
        $member_code = $request->post('member_code');
        $phone = $request->post('phone');
        if(User::where('member_code', $member_code)->where('id', '!=', Auth::id())->count()>0){
            $message = ".";
            return response()->json(["status" => "error", "data" => compact('message')]);
        }
        if($request->post('password') != "" && Hash::check($request->post('password'), Auth::user()->password)){
            $new_password = Hash::make($request->post('new_password'));
            
            User::updateOrCreate(['id'=>Auth::id()],
            [
                'password' => $new_password,
                'nickname' => $nickname,
                // 'member_code' => $member_code,
                'phone' => $phone
            ]);
            $message = ".";
            return response()->json(["status" => "success", "data" => compact('message')]);
        }else if($request->post('password') == ""){
            
            User::updateOrCreate(['id'=>Auth::id()],
            [
                'nickname' => $nickname,
                'member_code' => $member_code,
                'phone' => $phone
            ]);
            $message = "modifed your info.";
            return response()->json(["status" => "success", "data" => compact('message')]);
        }else{
            $message = "Please input the correct password.";
            return response()->json(["status" => "failed", "data" => compact('message')]);
        }
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_info(Request $request)
    {
        //echo Auth::id();
        $user_info = User::find(Auth::id(), ['money']);
        $user_info->cart_cnt = CardSell::where('user_id', Auth::id())->count();

        return response()->json(["status" => "success", "data" => compact('user_info')]);
        
    }
}
