<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FAQ;
use Yajra\DataTables\DataTables;

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
            $qnas = FAQ::where('is_del', 0)
                ->orderBy('updated_at', 'DESC');

            return DataTables::eloquent($qnas)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('question', function ($row) {
                    $popup = '<span data-id="' . $row->id . '" style="cursor:pointer" class="btnDetail">' . $row->question . '</span>';
                    return $popup;
                })
                ->rawColumns(['check', 'question'])
                ->make(true);
        }
        return view('user.contact.faq_list', compact('title'));
    }

    /**
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $faqInfo = FAQ::firstOrNew(['id' => $id]);
        return view('user.contact.faq_detail', compact('faqInfo', 'id'));
    }
    //
    public function save($id, Request $request)
    {
        // FAQ::updateOrCreate(
        //     ['nIdx' => $id],
        //     [
        //         'strQuestion' => $request->post('txtQuestionTitle'),
        //         'strQuestionContent' => $request->post('summernote'),
        //         'dtQuestion' => Carbon::now()
        //     ]
        // );
        // $data = '<script>alert("문의가 성공적으로 등록되었습니다.");window.opener.location.reload();window.close();</script>';
        // return view('test', compact('data'));
    }
    //
    public function delete($id, Request $request)
    {
        // $qna = FAQ::destroy($id);
        // return response()->json(["status" => "success", "data" => '']);
    }
}
