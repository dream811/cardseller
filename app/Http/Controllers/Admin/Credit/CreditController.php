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
    public function edit($id)
    {
        $title = "Edit";
        $creditInfo = Credit::firstOrNew(['id' => $id]);

        return view('admin.credit.detail', compact('creditInfo', 'id', 'title'));
    }
    //save
    public function save($id, Request $request)
    {

        $credit = Credit::find($id);
        $user = User::find($credit->user_id);
        $money = $user->money;
        $status = $request->post('status');
        $amount = $request->post('amount');
        if ($status == "PAID") {
            if($credit->status !="PAID"){
                $money += $amount;
                $user->update(['money' => $money]);
            }else{
                $money = $money -$credit->amount + $amount;
                $user->update(['money' => $money]);
            }
        } else if ($status == "OPENED" || $status == "CLOSED") {
            if($credit->status !="PAID"){
                $money -= $amount;
                $user->update(['money' => $money]);
            }
        }
        Credit::where('id', $id)->update(
            [
                'status' => $status,
                'amount' => $amount
            ]
        );


        return response()->json(["status" => "success", "data" => $credit]);
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
            $user->update(['money' => $user->money - $credit->amount]);
        }
        $credit->delete();
        return response()->json(["status" => "success", "data" => 'Successfully deleted.']);
    }

    // Change status
    public function state($id, Request $request)
    {
        $money = Credit::find($id);
        $user = User::find($money->user_id);

        if($request->post('status') == "PAID"){//
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
