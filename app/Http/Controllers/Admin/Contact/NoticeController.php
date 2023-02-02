<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Notice;
use App\MyLibs\CoupangConnector;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class NoticeController extends Controller
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
        $title = "News";


        if ($request->ajax()) {
            $notices = Notice::where('is_del', 0)
                ->orderBy('updated_at', 'DESC');

            return DataTables::eloquent($notices)
                ->addIndexColumn()
                
                ->addColumn('action', function ($row) {
                    $element = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-success btnEdit">수정</button>';
                    $element .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-secondary btnDelete">삭제</button>';
                    return $element;
                })
                ->addColumn('title', function ($row) {
                    $title = '<span data-id="' . $row->id . '" style="cursor:pointer; color:#007bff" class="btnDetail">' . $row->subject . '</span>';
                    return $title;
                })
                
                ->addColumn('writer', function ($row) {
                    $content = 'Admin';
                    return $content;
                })
                ->rawColumns(['check', 'writer', 'title', 'action'])
                ->make(true);
        }
        return view('admin.contact.notice_list', compact('title'));
    }

    /**
     * 문의 현시
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $noticeInfo = Notice::firstOrNew(['id' => $id]);
        $title = "Add";
        if($id == 0){
            $title = "Edit";
        } 
        return view('admin.contact.notice_detail', compact('noticeInfo', 'id', 'title'));
    }
    //save
    public function save($id, Request $request)
    {
        Notice::updateOrCreate(
            ['id' => $id],
            [
                'subject' => $request->post('subject'),
            ]
        );
        return response()->json(["status" => "success", "data" => 'Successfully saved.']);
    }
    //delete
    public function delete($id, Request $request)
    {
        $notice = Notice::destroy($id);
        return response()->json(["status" => "success", "data" => 'Successfully removed.']);
    }
}
