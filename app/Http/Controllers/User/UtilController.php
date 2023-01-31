<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Bank;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UtilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bank_info()
    {
        $bank_list = Bank::where('is_use', 1)->get();
        return response()->json(["status" => "success", "data" => compact('bank_list')]);
    }    
    
    public function referer_check(Request $request)
    {
        $cnt = count(User::whereIn('type', ['PARTNER', 'ADMIN', 'USER'])->where('member_code', $request->get('referer'))->get());
        if ($cnt > 0){
            return response()->json(["status" => "success", "data" => '']);
        }else{
            return response()->json(["status" => "failed", "data" => '.']);
        }
    }
    public function generate(Request $request)
    {
        // Output: 36e5e490f14b031e 
        $str_id =  substr(md5(time()), 0, 16);
        // Output: aa88ef597c77a5b3 
        $str_pwd = substr(sha1(time()), 0, 16);
        $user = User::create([
            'str_id' => $str_id,
            'password' => Hash::make($str_pwd),
            'email' => $str_id.'@mail.com'
        ]);
        
        return response()->json(["status" => "success", "data" => compact('str_id', 'str_pwd')]);
        
    }  
}
