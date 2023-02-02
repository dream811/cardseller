<?php

namespace App\Http\Controllers\Admin\Calculate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CardSell;
use App\Models\Card;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use DB;

class SaleController extends Controller
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
    public function index(Request $request)
    {

        $title = "Sale List";
        if ($request->ajax()) {
            $schedules = CardSell::where('is_del', 0)->orderBy('created_at', 'DESC');

            return DataTables::of($schedules)
            ->addIndexColumn()
                ->addColumn('user_info', function ($row) {
                    return $row->user->name;
                    
                })
                // ->addColumn('action', function ($row) {
                    
                //     // $btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                //     // $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                //     // $btn = '<button type="button" data-state="1" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-info btnState">정산</button>';
                //     $btn = '<button type="button" data-state="2" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-warning btnState">적특</button>';
                //     return $btn;
                // })
                ->rawColumns(['user_info'])
                ->make(true);
        }
        return view('admin.calculate.sale_list', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_index($userId, Request $request)
    {

        $title = "구매목록";

        if ($request->ajax()) {
            $schedules = Trading::where('is_del', 0)->where('user_id', $userId)->orderBy('created_at', 'DESC');

            return DataTables::of($schedules)
                ->addIndexColumn()
                // ->addColumn('chk-is-use', function ($row) {
                //     $checked = $row->is_use ? "checked" : "";
                //     $btn='<div>
                //         <div class="custom-control custom-switch">
                //         <input type="checkbox" class="custom-control-input chk-is-use" '.$checked.' data-id="'.$row->id.'" id="chkUse_'.$row->id.'">
                //         <label class="custom-control-label" for="chkUse_'.$row->id.'"></label>
                //         </div>
                //     </div>';
                //     //$btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                //     // $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                //     return $btn;
                // })
                ->addColumn('user_info', function ($row) {
                    $name = User::find($row->user_id)->name;
                    $str_id = User::find($row->user_id)->str_id;
                    $tags = '<li style="list-style: none;" class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="badge " style="padding:0px; right:unset; top:3px; font-size:12px">'.$name.'('.$str_id.')</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <a href="javascript:void(0)" class="dropdown-item btnEditMember" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted text-sm">'.$name.' 정보수정</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoDeposit" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted text-sm " >입금내역</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoWithdraw" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted text-sm">출금내역</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoTrading" data-id="'.$row->user_id.'" >
                            <span class="float-center text-muted text-sm" >구매내역</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoResult" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted text-sm">배당금내역</span>
                        </a>
                        </div>
                    </li>';
                    return $tags;
                })
                ->addColumn('level', function ($row) {
                    $name = User::find($row->user_id)->userLevel->name;
                    
                    return $name;
                })
                ->addColumn('state_info', function ($row) {
                    $state = "미지급";
                    if($row->state == 0){
                        $state = "미지급";
                    }else if($row->state == 1){
                        $state = "지급";
                    }else{
                        $state = "실격";
                    }
                    return $state;
                })
                ->addColumn('action', function ($row) {
                    
                    // $btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                    // $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                    // $btn = '<button type="button" data-state="1" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-info btnState">정산</button>';
                    $btn = '<button type="button" data-state="2" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-warning btnState">적특</button>';
                    return $btn;
                })
                ->rawColumns(['action','user_info', 'level'])
                ->make(true);
        }
        return view('admin.calculate.user_trading_list', compact('title', 'userId'));
    }

    //수정하려는 유저 선택(post)
    public function edit($id = 0)
    {
        $title = "수정";
        if ($id == 0) {
            $title = "추가";
        }

        $trading = Trading::where('is_del', 0)
            ->where('id', $id)
            ->firstOrNew();
        $users = User::where('is_del', 0)->where('is_use', 1)->where('type', 'USER')->select('id', 'str_id', 'name', 'nickname')->get();
        $coins = Coin::where('is_use', 1)->get();
        return view('admin.calculate.trading_detail', compact('title', 'id', 'trading', 'users', 'coins'));
    }
    public function save(Request $request)
    {

        $data = [
            'start_time' => $request->post('start_time'),
            'end_time' => $request->post('end_time'),
            'calculate_time' => $request->post('calculate_time'),
            'is_use' => $request->post('is_use'),
            'is_del' => 0,
        ];
        
        
        $schedule = Trading::updateOrCreate(
            ['id' => $request->post('id')],
            $data
        );
        return response()->json(["status" => "success", "data" => $schedule]);
    }

    //사용상태 변경
    public function state($id, Request $request)
    {
        $state = $request->post('state');
        $trade = Trading::find($id);

        

        if($state== 1 ){//정산
            if($trade->state == 0){//미정산중이라면
                User::find($trade->user_id)->update([
                    'money' => DB::raw('money + '. $trade->payout_amount),//배당머니 정산
                    'profit_sum' => DB::raw('profit_sum + '. $trade->add_amount),
                ]);
            }else if($trade->state == 2){//적특이였다면
                User::find($trade->user_id)->update([
                    'money' => DB::raw('money + '. $trade->add_amount),//배당머니 정산
                    'profit_sum' => DB::raw('profit_sum + '. $trade->add_amount),
                ]);
            }
        }else if($state==2){//적특
            if($trade->state == 0){//미정산중이라면
                User::find($trade->user_id)->update([
                    'money' => DB::raw('money + '. $trade->order_amount)//원금 돌려준다
                    
                ]);
            }else if($trade->state == 1){//정산이였다면
                User::find($trade->user_id)->update([
                    'money' => DB::raw('money - '. $trade->add_amount),//배당머니 정산
                    'profit_sum' => DB::raw('profit_sum - '. $trade->add_amount),
                ]);
            }
        }
        // $data['mb_intercept_date']  = $date->format('Y-m-d H:i:s');
        $trade->update(            
            [
                'state' => $state,
                'calculated_at' => $state== 1 ? Carbon::now() : NULL,
            ]
        );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $state]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  $accountId
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $schedule = Trading::where('id', $id)->delete();
        return response()->json(["status" => "success", "data" => $schedule]);
    }
}
