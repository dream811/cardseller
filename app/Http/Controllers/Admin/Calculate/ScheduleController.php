<?php

namespace App\Http\Controllers\Admin\Calculate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ScheduleController extends Controller
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

        $title = "정산일정관리";

        if ($request->ajax()) {
            $schedules = Schedule::where('is_del', 0)->orderBy('start_time');

            return DataTables::of($schedules)
                ->addIndexColumn()
                ->addColumn('chk-is-use', function ($row) {
                    $checked = $row->is_use ? "checked" : "";
                    $btn='<div >
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input chk-is-use" '.$checked.' data-id="'.$row->id.'" id="chkUse_'.$row->id.'">
                        <label class="custom-control-label" for="chkUse_'.$row->id.'"></label>
                        </div>
                    </div>';
                    //$btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                    // $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    
                    $btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                    return $btn;
                })
                ->rawColumns(['action','chk-is-use'])
                ->make(true);
        }
        return view('admin.calculate.schedule', compact('title'));
    }

    //수정하려는 유저 선택(post)
    public function edit($id = 0)
    {
        $title = "수정";
        if ($id == 0) {
            $title = "추가";
        }

        $schedule = Schedule::where('is_del', 0)
            ->where('id', $id)
            ->firstOrNew();

        return view('admin.calculate.schedule_detail', compact('title', 'id', 'schedule'));
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
        
        
        $schedule = Schedule::updateOrCreate(
            ['id' => $request->post('id')],
            $data
        );
        return response()->json(["status" => "success", "data" => $schedule]);
    }

    //사용상태 변경
    public function state($id, Request $request)
    {
        $status = $request->post('status');
        $id = Schedule::where('id', $id)
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
        $schedule = Schedule::where('id', $id)->delete();
        return response()->json(["status" => "success", "data" => $schedule]);
    }
}
