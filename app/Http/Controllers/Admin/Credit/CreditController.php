<?php

namespace App\Http\Controllers\Admin\Credit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Credit;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CreditController extends Controller
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
        $title = "Credit Card";
        

        if ($request->ajax()) {
            $monies = Credit::where('is_del', 0)->orderBy('id', 'DESC');
                

            return DataTables::eloquent($monies)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '<button type="button" data-type="'.$row->type.'" data-id="' . $row->id . '" class="m-1 btn btn-sm btn-warning btnEdit">Edit</button>';
                    $element .= '<button type="button" data-type="'.$row->type.'" data-id="' . $row->id . '" class="m-1 btn btn-sm btn-danger btnDelete">Delete</button>';
                    return $element;
                })
                ->editColumn('user_id', function ($row) {
                    return $row->user->str_id;
                })
                ->editColumn('created_at', function ($row) {
                    return date('Y-m-d H:i:s', strtotime($row->created_at));
                })
                ->editColumn('status', function ($row) {
                    $status = '<span style="width:80px;" class="badge badge-success">'.$row->status.'</span>';
                    return $status;
                })
                ->rawColumns(['check','status', 'user_id', 'action'])
                ->make(true);
        }
        return view('admin.credit.list', compact('title'));
    }


    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $creditInfo = Credit::firstOrNew(['id' => $id]);

        return view('admin.user.ChargeDetail', compact('creditInfo', 'id'));
    }
    //save
    public function save($id, Request $request)
    {

        $credit = Credit::find($id);
        $user = User::where('mb_id', $credit->user_id)->first();
        $money = $user->money;
        $status = $request->post('status');
        if ($status == "PAID") {
            $money += $submoney->money;
            $user->update(['mb_money' => $money]);
        } else if ($status == "OPENED") {
            $money += $submoney->mo_money;
            $user->update(['mb_money' => $money]);
        } else if($status == "CLOSED") {

        }
        $content = $confirm == 1 ? "accept" : "cancel";
        Money::where('mo_id', $id)->update(
            [
                'mo_state' => $confirm
            ]
        );


        $data = '<script>alert("' . $content . 'ss.");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
    }
    // delete
    public function delete($id, Request $request)
    {
        $credit = Credit::find($id);
        $user = User::where('id', $credit->user_id)->first();
        
        if ($credit->status == "PAID") {
            if ($user->money < $credit->amount ) {
                return response()->json(["status" => "failed", "data" => 'User\'s current money isn\'t enough.']);
            }
            $user->update(['money' => $user->money - $money->amount]);
        }
        $money->delete();
        return response()->json(["status" => "success", "data" => 'Successfully deleted.']);
    }

    // Change status
    public function state($id, Request $request)
    {
        $money = Credit::find($id);
        $user = User::find($money->user_id);

        if($request->post('status') == "PAID"){//승인
            if($money->status != "PAID" ){
                $user->update(['money' => $user->money + $money->amount]);
            }
            $money->update([
                'status' => "PAID",
                'created_at' => Carbon::now(),
            ]);
        }else {//
            if($money->status == "PAID" ){
                $user->update(['money' => $user->money - $money->amount]);
            }
            $money->update([
                'status' => $request->post('status'),
            ]);
        }
        return response()->json(["status" => "success", "data" => 'Successfully changed.']);
    }
}
