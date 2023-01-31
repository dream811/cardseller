<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class MessageController extends Controller
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
            $messages = Message::where('is_del', 0)
                ->where('receiver_id', Auth::id())
                ->orderBy('id', 'DESC');

            return DataTables::eloquent($messages)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = "";
                    if(!$row->is_read){
                        $element = '&nbsp;&nbsp;<button type="button" data-read="'.$row->is_read.'" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-success btnRead"></button>';
                    }
                    $element .= '&nbsp;&nbsp;<button type="button" data-read="'.$row->is_read.'" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-warning btnDelete"></button>';
                    
                    return $element;
                })
                ->addColumn('title', function ($row) {
                    $title = '<span data-read="'.$row->is_read.'" data-id="' . $row->id . '" style="cursor:pointer" class="btnDetail">' . $row->subject . '</span>';
                    return $title;
                })
                
                ->editColumn('send_date', function ($row) {
                    return date('Y-m-d', strtotime($row->send_date));
                })
                ->editColumn('read_date', function ($row) {
                    if ($row->is_read)
                        return date('Y-m-d', strtotime($row->read_date));
                    else
                        return "";
                })
                ->rawColumns(['check', 'title', 'action'])
                ->make(true);
        }
        return view('user.message_list', compact('title'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $msgInfo = Message::firstOrNew(['id' => $id]);

        return view('user.message_detail', compact('msgInfo', 'id'));
    }
    // //
    // public function save($id, Request $request)
    // {
    //     if($request->post('type')){
    //         $ready_bankQna = QNA::where('type', 1)->where('is_answer', 0)->get();
    //         if(count($ready_bankQna)){
    //             $message = "";
    //             return response()->json(["status" => "error", "data" => compact('message')]);
    //         }
    //     }
    //     $qna = QNA::updateOrCreate(
    //         ['id' => $id],
    //         [
    //             'user_id' => Auth::id(),
    //             'subject' => $request->post('subject'),
    //             'content' => $request->post('content'),
    //             'type' => $request->post('type'),
    //             'requested_date' => Carbon::now()
    //         ]
    //     );
    //     if ($request->ajax()) {
    //         return response()->json(["status" => "success", "data" => compact('qna')]);
    //     }else{
    //         $data = '<script>alert("");window.opener.location.reload();window.close();</script>';
    //         return view('test', compact('data'));
    //     }
    // }
    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function read($id)
    {
        if($id == "all"){
            Message::where('receiver_id', Auth::id())->update(['is_read' => 1, 'read_date' => Carbon::now()]);
            $data = ['type'=>0, 'message' =>'.'];
            return response()->json(["status" => "success", "data" => $data]);
        }else{
            Message::where('id', $id)->update(['is_read' => 1, 'read_date' => Carbon::now()]);
            $data = ['type'=>1, 'message' =>'.'];
            return response()->json(["status" => "success", "data" => $data]);
        }

        
    }
    //
    public function delete($id, Request $request)
    {
        if($id == "all"){
            Message::where('receiver_id', Auth::id())->delete();
            $data = ['type'=>0, 'message' =>''];
            return response()->json(["status" => "success", "data" => $data]);
        }else{
            Message::destroy($id);
            $data = ['type'=>1, 'message' =>''];
            return response()->json(["status" => "success", "data" => $data]);
        }
        
        return response()->json(["status" => "success", "data" => '']);
    }
}
