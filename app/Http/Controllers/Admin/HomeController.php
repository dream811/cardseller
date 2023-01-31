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

    public function alarm_state($userId, Request $request)
    {
        $user = User::find($userId);
        $alarm_id = $request->post('alarm_id');
        if(strpos($user->add_feature, "($alarm_id)") !== false){
            $add_feature = str_replace("($alarm_id)","", $user->add_feature);
        }else{
            if(strpos($user->add_feature, ")\"") !== false){
                $add_feature = str_replace(")\"",")($alarm_id)\"", $user->add_feature);
            }else{
                $add_feature = str_replace("\"\"","\"($alarm_id)\"", $user->add_feature);
            }
        }
        $add_feature = str_replace("alarm","\"alarm\"", $add_feature);
        $user->update(            
            ['add_feature' => $add_feature]
        );

        return response()->json(["status" => "success", "data" => compact('add_feature')]);
    }
}
