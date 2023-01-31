<?php

namespace App\Http\Controllers\Admin\Calculate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trading;
use App\Models\Coin;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use DB;

class HistoryController extends Controller
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
    public function index(Request $request)
    {

        $title = "일/월 입출금";
        $fromDate = date("Y-m-d", strtotime("-1 months"));
        $toDate = date("Y-m-d");
        if ($request->ajax()) {
            $fromDate = $request->get('txtFrom');
            $toDate = $request->get('txtTo');

            if($request->get('txtType') == 'member'){
                $lists = DB::select("SELECT
                    users.id,
                    users.name,
                    users.nickname,
                    users.money,
                    IFNULL(SUM(cl.`order_amount`),0) AS ord_amt,
                    IFNULL(SUM(cl.`payout_amount`),0) AS pay_amt,
                    IFNULL(SUM(cl.`add_amount`),0) AS add_amt,
                    SUM(CASE WHEN el.type = 0 THEN amount ELSE 0 END) AS deposit_amt,
                    SUM(CASE WHEN el.type=1 THEN amount ELSE 0 END) AS withdraw_amt,
                    SUM(CASE WHEN el.type = 0 THEN amount ELSE 0 END) - SUM(CASE WHEN el.type=1 THEN amount ELSE 0 END) as profit_amt
                FROM
                    users
                    LEFT JOIN (SELECT * FROM  coin_trade_list WHERE created_at >= '${fromDate}' AND created_at <= '${toDate}' GROUP BY user_id) AS cl
                    ON users.id = cl.`user_id`
                    LEFT JOIN (SELECT * FROM  exchange_list WHERE requested_date >= '${fromDate}' AND requested_date <= '${toDate}' GROUP BY user_id) AS el
                    ON users.id = el.`user_id` 
                WHERE users.type='USER' AND users.is_use=1 AND users.is_del=0 AND ( users.referer IS NULL OR users.referer='')
                GROUP BY users.id");

                return DataTables::of($lists)
                ->make(true);
            }else if($request->get('txtType') == 'partner'){
                $lists = DB::select("SELECT member.*, SUM(deposit_amt-withdraw_amt) AS profit_amt, ref.str_id AS ref_id, ref.name, ref.nickname
                FROM
                  (SELECT
                    users.id,
                    users.referer,
                    SUM(users.money) AS money,
                    IFNULL(SUM(cl.`order_amount`), 0) AS ord_amt,
                    IFNULL(SUM(cl.`payout_amount`), 0) AS pay_amt,
                    IFNULL(SUM(cl.`add_amount`), 0) AS add_amt,
                    SUM( CASE WHEN el.type = 0 THEN amount ELSE 0 END ) AS deposit_amt,
                    SUM( CASE WHEN el.type = 1 THEN amount ELSE 0 END ) AS withdraw_amt
                  FROM
                    users
                    LEFT JOIN
                      (SELECT * FROM coin_trade_list WHERE created_at >= '${fromDate}' AND created_at <= '${toDate}' GROUP BY user_id) AS cl ON users.id = cl.`user_id`
                    LEFT JOIN
                      (SELECT * FROM exchange_list WHERE requested_date >= '${fromDate}' AND requested_date <= '${toDate}' GROUP BY user_id) AS el ON users.id = el.`user_id`
                  WHERE users.type = 'USER' AND users.is_use = 1 AND users.is_del = 0 AND users.`referer` IS NOT NULL
                  GROUP BY users.referer) AS member
                  LEFT JOIN users AS ref
                    ON member.referer = ref.str_id
                WHERE ref.type = 'PARTNER'");

                return DataTables::of($lists)
                ->editColumn('name', function ($row) {
                    $name = '<span data-id="' . $row->ref_id . '" style="cursor:pointer; color:#007bff" class="btnDetail">' . $row->name . '</span>';
                    return $name;
                })
                ->rawColumns(['name'])
                ->make(true);
            }
            
        }
        return view('admin.calculate.history_list', compact('title', 'fromDate', 'toDate'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function partner_history($id, $fromDate, $toDate, Request $request)
    {

        $title = "하부회원";

        if ($request->ajax()) {
            
            $lists = DB::select("SELECT
                users.id,
                users.name,
                users.nickname,
                users.money,
                IFNULL(SUM(cl.`order_amount`),0) AS ord_amt,
                IFNULL(SUM(cl.`payout_amount`),0) AS pay_amt,
                IFNULL(SUM(cl.`add_amount`),0) AS add_amt,
                SUM(CASE WHEN el.type = 0 THEN amount ELSE 0 END) AS deposit_amt,
                SUM(CASE WHEN el.type=1 THEN amount ELSE 0 END) AS withdraw_amt,
                SUM(CASE WHEN el.type = 0 THEN amount ELSE 0 END) - SUM(CASE WHEN el.type=1 THEN amount ELSE 0 END) as profit_amt
            FROM
                users
                LEFT JOIN (SELECT * FROM  coin_trade_list WHERE created_at >= '${fromDate}' AND created_at <= '${toDate}' GROUP BY user_id) AS cl
                ON users.id = cl.`user_id`
                LEFT JOIN (SELECT * FROM  exchange_list WHERE requested_date >= '${fromDate}' AND requested_date <= '${toDate}' GROUP BY user_id) AS el
                ON users.id = el.`user_id` 
            WHERE users.type='USER' AND users.is_use=1 AND users.is_del=0 AND users.referer='${id}'
            GROUP BY users.id");

            return DataTables::of($lists)
            ->make(true);
        }
        return view('admin.calculate.partner_history_list', compact('title', 'id', 'fromDate', 'toDate'));
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
        return view('admin.calculate.result_detail', compact('title', 'id', 'trading', 'users', 'coins'));
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
        $status = $request->post('status');
        $id = Trading::where('id', $id)
            ->update(            
                ['is_use' => $status]
            );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $status]);
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
