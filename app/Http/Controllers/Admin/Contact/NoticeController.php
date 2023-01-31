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
        $title = "공지사항";


        if ($request->ajax()) {
            $notices = Notice::where('is_del', 0)
                ->orderBy('updated_at', 'DESC');

            return DataTables::eloquent($notices)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-success btnEdit">수정</button>';
                    $element .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-secondary btnDelete">삭제</button>';
                    return $element;
                })
                ->addColumn('title', function ($row) {
                    $title = '<span data-id="' . $row->id . '" style="cursor:pointer; color:#007bff" class="btnDetail">' . $row->subject . '</span>';
                    return $title;
                })
                ->addColumn('popupInfo', function ($row) {
                    $popup = $row->is_popup == 1 ? "팝업공지" : "일반공지";
                    return $popup;
                })
                ->addColumn('writer', function ($row) {
                    $content = '관리자';
                    return $content;
                })
                ->rawColumns(['check', 'popupInfo', 'writer', 'title', 'action'])
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
        $title = "작성";
        if($id == 0){
            $title = "수정";
        } 
        return view('admin.contact.notice_detail', compact('noticeInfo', 'id', 'title'));
    }
    //답변 저장
    public function save($id, Request $request)
    {
        Notice::updateOrCreate(
            ['id' => $id],
            [
                'subject' => $request->post('subject'),
                'content' => $request->post('content'),
                'is_popup' => $request->post('chk_is_popup'),
            ]
        );
        return response()->json(["status" => "success", "data" => '성과적으로 작성되었습니다.']);
    }
    //문의내용 삭제
    public function delete($id, Request $request)
    {
        $notice = Notice::destroy($id);
        return response()->json(["status" => "success", "data" => '성과적으로 삭제되었습니다.']);
    }
}
