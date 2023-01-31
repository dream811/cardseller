<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\FAQ;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class FAQController extends Controller
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
        $title = "FAQ";


        if ($request->ajax()) {
            $qnas = FAQ::where('bIsDel', 0)
                ->orderBy('updated_at', 'DESC');

            return DataTables::eloquent($qnas)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->nIdx . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '<button type="button" data-id="' . $row->nIdx . '" style="font-size:10px !important;" class="btn btn-xs btn-secondary btnDel">삭제</button>';
                    return $element;
                })
                ->addColumn('questionInfo', function ($row) {
                    $popup = '<span data-id="' . $row->nIdx . '" style="cursor:pointer" class="btnEdit">' . $row->strQuestion . '</span>';
                    return $popup;
                })
                ->addColumn('writer', function ($row) {
                    return 'Admin';
                })
                ->rawColumns(['check', 'questionInfo', 'writer', 'action'])
                ->make(true);
        }
        return view('admin.contact.faq_list', compact('title'));
    }

    /**
     * 문의 현시
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $faqInfo = FAQ::firstOrNew(['nIdx' => $id]);

        return view('admin.contact.FAQDetail', compact('faqInfo', 'id'));
    }
    //답변 저장
    public function save($id, Request $request)
    {
        FAQ::updateOrCreate(
            ['nIdx' => $id],
            [
                'strAnswer' => $request->post('summernote'),
                'strQuestion' => $request->post('txtQuestion'),
            ]
        );
        $data = '<script>alert("답변이 성과적으로 등록되었습니다.");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
    }
    //문의내용 삭제
    public function delete($id, Request $request)
    {
        $qna = FAQ::destroy($id);
        return response()->json(["status" => "success", "data" => '문의가 성과적으로 삭제되었습니다.']);
    }
}
