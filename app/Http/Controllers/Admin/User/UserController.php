<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bank;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
    public function index(Request $request)
    {

        $title = "Users";

        if ($request->ajax()) {
            $users = User::where('type', 'USER')
                ->where('is_del', 0);

            return DataTables::of($users)
                ->addIndexColumn()
                
                ->editColumn('is_use', function ($row) {
                    $checked = $row->is_use == 1 ? "checked" : "";
                    $btn='<div>
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input chk-is-use" '.$checked.' data-id="'.$row->id.'" id="chkUse_'.$row->id.'">
                        <label class="custom-control-label" for="chkUse_'.$row->id.'"></label>
                        </div>
                    </div>';
                    return $btn;
                })                
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" class="btn btn-primary btnEdit">Edit</button>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" class="ml-1 btn btn-danger btnDelete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action', 'is_use'])
                ->make(true);
        }
        return view('admin.user.list', compact('title'));
    }

    //수정하려는 유저 선택(post)
    public function edit($userId = 0)
    {
        $title = "Edit";
        if ($userId == 0) {
            $title = "New";
        }

        $user = User::where('is_del', 0)
            ->where('id', $userId)
            ->firstOrNew();
        if($userId == 0) $user->type = "USER";
        return view('admin.user.detail', compact('title', 'userId', 'user'));
    }
    public function save(Request $request)
    {
        //$path = $request->post('beforeImage');

        // if ($request->file('fileImage')) {
        //     if ($path != "") {
        //         Storage::delete('public/' . $path);
        //     }

        //     $imageFile = $request->file('fileImage');
        //     $new_name = rand() . '.' . $imageFile->getClientOriginalExtension();
        //     $old_name = $imageFile->getClientOriginalName();
        //     $path = url('storage') . '/' . $request->file('fileImage')->storeAs('/uploads/profile_images', $new_name, 'public');
        // }
        $data = [
            'money' => $request->post('money'),
            'is_use' => $request->post('is_use'),
            'is_del' => 0,
        ];
        // if ($request->post('id') == 0) {
        //     $data['password']  = Hash::make($request->post('password'));
        // }
        if ($request->post('password') != "") {
            $data['password']  = Hash::make($request->post('password'));
        }
        // $date = new DateTime;
        // if ($request->post('is_use') == 0) {
        //     $data['mb_intercept_date']  = $date->format('Ymd');
        // }
        $user = User::updateOrCreate(
            ['id' => $request->post('id')],
            $data
        );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $user]);
    }
    //사용상태 변경
    public function state($userId, Request $request)
    {
        $status = $request->post('status');
        $user = User::where('id', $userId)
            ->update(            
                ['is_use' => $status]
            );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $user]);
    }

    public function check(Request $request)
    {
        $id_check = 1;
        if (User::where('str_id', $request->post('str_id'))->count()) {
            $id_check = 0;
        }
        return response()->json(["status" => "success", "data" => compact('id_check')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $accountId
     * @return \Illuminate\Http\Response
     */
    public function delete($userId)
    {
        $user = User::where('id', $userId)
            ->update(            
                ['is_del' => 1]
            );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $user]);
    }
}
