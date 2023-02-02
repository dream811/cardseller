<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
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

        $title = "User Management";

        if ($request->ajax()) {
            $users = User::where('type', 'USER')
                ->where('level', '<', 9)
                ->orderBy('name');

            return DataTables::of($users)
                ->addIndexColumn()
                
                ->editColumn('is_use', function ($row) {
                    $checked = $row->is_use == 1 ? "checked" : "";
                    $btn='<div>
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" '.$checked.' id="chkUse_'.$row->id.'">
                        <label class="custom-control-label" for="chkUse_'.$row->id.'"></label>
                        </div>
                    </div>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-primary btnEdit">Edit</button>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-danger btnDelete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action', 'level', 'is_use'])
                ->make(true);
        }
        return view('admin.user.list', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function guide(Request $request)
    {
        $title = "Guide";
        $guide = Setting::first()->guide;
        return view('admin.setting.guide', compact('title', 'guide'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveGuide(Request $request)
    {
        
        $guide = $request->post('guide');
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'guide' => $guide,
            ]
        );
        
        return redirect()->route('admin.setting.guide');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bank(Request $request)
    {
        $title = "APIRONE";
        $setting = Setting::first();
        return view('admin.setting.bank', compact('title', 'setting'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveBank(Request $request)
    {
        
        $apirone_account = $request->post('apirone_account');
        $apirone_trans_key = $request->post('apirone_trans_key');
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'apirone_account' => $apirone_account,
                'apirone_trans_key' => $apirone_trans_key,
            ]
        );
        
        return redirect()->route('admin.setting.bank');
        
    }
}
