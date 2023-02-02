<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exchange;
use App\Models\Trading;
use App\Models\QNA;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $deposit = Cash::where
        return view('admin.home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function realtime_info()
    {
        
        $new_users = count(User::where('is_use', 2)->get());
        $levelup_users = count(User::where('type', 'USER')->where('users.is_use', 1)->leftJoin('user_level', function($join) {
            $join->on('user_level.level', '=', 'users.level');
        })->where('users.buy_sum', '>', DB::raw('user_level.levelup_amount'))->where('users.levelup_flag', 0)->get());
        $new_deposits = count(Exchange::where('type', 0)->where('state', 0)->where('is_check', 0)->get());
        $new_withdraws = count(Exchange::where('type', 1)->where('state', 0)->where('is_check', 0)->get());
        $new_qnas = count(QNA::where('type', 0)->where('is_answer', 0)->where('is_check', 0)->get());
        $new_acc_qnas = count(QNA::where('type', 1)->where('is_answer', 0)->where('is_check', 0)->get());
        $new_tradings = count(Trading::where('state', 0)->where('is_check', 0)->get());
        // $level_users = DB::select("SELECT  user_level.name, user_level.level, COUNT(users.id) AS cnt FROM user_level LEFT JOIN users  ON  user_level.level = users.level WHERE users.type='USER' GROUP BY user_level.level");
        return response()->json(["status" => "success", "data" => compact('new_users', 'levelup_users', 'new_deposits', 'new_withdraws', 'new_qnas', 'new_acc_qnas', 'new_tradings')]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mypage(Request $request)
    {
        $title="My Info";
        return view('admin.mypage', compact('title'));
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
}
