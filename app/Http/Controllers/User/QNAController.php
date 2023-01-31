<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QNA;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

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
        $title = "";


        if ($request->ajax()) {
            $qnas = QNA::where('is_del', 0)
                ->where('user_id', Auth::id())
                ->orderBy('id', 'DESC');

            return DataTables::eloquent($qnas)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    if($row->is_answer || $row->type){
                        $element = '&nbsp;&nbsp;<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-success btnDetail"></button>';
                    }else{
                        
                        $element = '&nbsp;&nbsp;<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-success btnEdit"></button>';
                    }
                    return $element;
                })
                ->addColumn('title', function ($row) {
                    $question = '<span data-id="' . $row->id . '" style="cursor:pointer" class="btnDetail">' . $row->subject . '</span>';
                    return $question;
                })
                ->addColumn('type', function ($row) {
                    $type = $row->type == 1 ? "" : "";
                    return $type;
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
                ->rawColumns(['check', 'title', 'action'])
                ->make(true);
        }
        return view('user.qna_list', compact('title'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $qnaInfo = QNA::firstOrNew(['id' => $id]);

        return view('user.qna_detail', compact('qnaInfo', 'id'));
    }
    //
    public function save($id, Request $request)
    {
        if($request->post('type')){
            $ready_bankQna = QNA::where('type', 1)->where('user_id', Auth::id())->where('is_answer', 0)->get();
            if(count($ready_bankQna)){
                $message = ".";
                return response()->json(["status" => "error", "data" => compact('message')]);
            }
        }
        $qna = QNA::updateOrCreate(
            ['id' => $id],
            [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'subject' => $request->post('subject'),
                'content' => $request->post('content'),
                'type' => $request->post('type'),
                'requested_date' => Carbon::now()
            ]
        );
        if ($request->ajax()) {
            return response()->json(["status" => "success", "data" => compact('qna')]);
        }else{
            $data = '<script>alert(".");window.opener.location.reload();window.close();</script>';
            return view('test', compact('data'));
        }
    }
    //
    public function delete($id, Request $request)
    {
        QNA::destroy($id);
        return response()->json(["status" => "success", "data" => '.']);
    }
}
