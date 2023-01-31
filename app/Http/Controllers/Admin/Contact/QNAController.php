<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QNA;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class QNAController extends Controller
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
        $title = "1대1문의";
        QNA::where('is_check', 0)->where('type', 0)->update(['is_check' => 1]);
        if ($request->ajax()) {
            $qnas = QNA::where('is_del', 0)->where('type', 0)
                ->orderBy('id', 'DESC');

            return DataTables::eloquent($qnas)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '&nbsp;&nbsp;<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-success btnEdit">수정</button>';
                    $element .= '&nbsp;&nbsp;<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-secondary btnDelete">삭제</button>';
                    return $element;
                })
                ->editColumn('type', function ($row) {
                    $type = $row->type == 1 ? "계좌문의" : "일반문의";
                    return $type;
                })
                ->addColumn('title', function ($row) {
                    $title = '<span data-id="' . $row->id . '" style="cursor:pointer; color:#007bff" class="btnDetail">' . $row->subject . '</span>';
                    return $title;
                })
                ->editColumn('requested_date', function ($row) {
                    return date('Y-m-d', strtotime($row->requested_date));
                })
                ->editColumn('answered_date', function ($row) {
                    if ($row->is_answer)
                        return date('Y-m-d', strtotime($row->answered_date));
                    else
                        return "";
                })
                ->rawColumns(['check', 'action', 'title'])
                ->make(true);
        }
        $type1 = 0;
        return view('admin.contact.qna_list', compact('title', 'type1'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function acc_index(Request $request)
    {
        $title = "계좌문의";
        QNA::where('is_check', 0)->where('type', 1)->update(['is_check' => 1]);
        if ($request->ajax()) {
            $qnas = QNA::where('is_del', 0)->where('type', 1)
                ->orderBy('id', 'DESC');

            return DataTables::eloquent($qnas)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '&nbsp;&nbsp;<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-success btnEdit">수정</button>';
                    $element .= '&nbsp;&nbsp;<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-secondary btnDelete">삭제</button>';
                    return $element;
                })
                ->editColumn('type', function ($row) {
                    $type = $row->type == 1 ? "계좌문의" : "일반문의";
                    return $type;
                })
                ->addColumn('title', function ($row) {
                    $title = '<span data-id="' . $row->id . '" style="cursor:pointer; color:#007bff" class="btnDetail">' . $row->subject . '</span>';
                    return $title;
                })
                ->editColumn('requested_date', function ($row) {
                    return date('Y-m-d', strtotime($row->requested_date));
                })
                ->editColumn('answered_date', function ($row) {
                    if ($row->is_answer)
                        return date('Y-m-d', strtotime($row->answered_date));
                    else
                        return "";
                })
                ->rawColumns(['check', 'action', 'title'])
                ->make(true);
        }
        $type1 = 1;
        return view('admin.contact.qna_list', compact('title', 'type1'));
    }

    /**
     * 문의 현시
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $qnaInfo = QNA::firstOrNew(['id' => $id]);
        $title = "New";
        if($id == 0){
            $title = "Edit";
        }
        return view('admin.contact.qna_detail', compact('qnaInfo', 'id', 'title'));
    }
    //답변 저장
    public function save($id, Request $request)
    {
        QNA::updateOrCreate(
            ['id' => $id],
            [
                'answer' => $request->post('answer'),
                'answered_date' => Carbon::now(),
                'is_answer' => '1'
            ]
        );
        // $data = '<script>alert("registered.");window.opener.location.reload();window.close();</script>';
        // return view('test', compact('data'));
        return response()->json(["status" => "success", "data" => 'registered.']);
    }
    //문의내용 삭제
    public function delete($id, Request $request)
    {
        $qna = QNA::destroy($id);
        return response()->json(["status" => "success", "data" => 'removed.']);
    }
}
