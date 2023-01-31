<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\UserLevel;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class MsgController extends Controller
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
        $title = "쪽지";


        if ($request->ajax()) {
            $messages = Message::where('is_del', 0)
                ->orderBy('send_date', 'DESC');
            return DataTables::eloquent($messages)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = "";
                    if(!$row->is_read){
                        $element = '&nbsp;&nbsp;<button type="button" data-read="'.$row->is_read.'" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-success btnEdit">수정</button>';
                    }
                    $element .= '&nbsp;&nbsp;<button type="button" data-read="'.$row->is_read.'" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-warning btnDelete">삭제</button>';
                    
                    return $element;
                })
                ->addColumn('title', function ($row) {
                    $title = '<span data-read="'.$row->is_read.'" data-id="' . $row->id . '" style="cursor:pointer; color:#007bff" class="dtlPartner">' . $row->subject . '</span>';
                    return $title;
                })
                
                ->editColumn('send_date', function ($row) {
                    return date('Y-m-d', strtotime($row->send_date));
                })
                ->editColumn('is_read', function ($row) {
                    $state = "읽음";
                    if(!$row->is_read){
                        $state="대기";
                    }
                    return $state;
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
        return view('admin.contact.msg_list', compact('title'));
    }

    /**
     * 문의 현시
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $title = "작성";
        if($id == 0){
            $title = "수정";
        } 
        $msgInfo = Message::firstOrNew(['id' => $id]);
        $users = User::where('is_del', 0)->where('is_use', 1)->where('type', 'USER')->select('id', 'str_id', 'name', 'nickname')->get();
        $levels = UserLevel::where('is_del', 0)->where('is_use', 1)->select('id', 'level', 'name')->get();
        return view('admin.contact.msg_detail', compact('msgInfo', 'id', 'title', 'users', 'levels'));
    }
    //답변 저장
    public function save($id, Request $request)
    {
        
        if($id == 0 && $request->post('chk_all') == 'all'){
            
            $users =  User::where('is_del', 0)->where('is_use', 1)->where('type', 'USER')->select('id', 'str_id', 'name', 'nickname')->get();
            $data = array();
            foreach($users as $user)
            {
                if(!empty($user))
                {
                    $data[] =[
                        'subject' => $request->post('subject'),
                        'content' => $request->post('content'),
                        'send_date' => Carbon::now(),
                        'is_read' => '0',
                        'sender_id' => Auth::id(),
                        'sender_name' => Auth::user()->name,
                        'receiver_id' => $user->id,
                        'receiver_name' => $user->name,
                        'is_del' => '0',
                    ];                 

                }
            }
            Message::insert($data);
                
           
        }
        else if($id == 0 && intval($request->post('chk_all')) > 0){
            $users =  User::where('is_del', 0)->where('is_use', 1)->where('type', 'USER')->where('level', $request->post('chk_all'))->select('id', 'str_id', 'name', 'nickname')->get();
            $data = array();
            foreach($users as $user)
            {
                if(!empty($user))
                {
                    $data[] =[
                        'subject' => $request->post('subject'),
                        'content' => $request->post('content'),
                        'send_date' => Carbon::now(),
                        'is_read' => '0',
                        'sender_id' => Auth::id(),
                        'sender_name' => Auth::user()->name,
                        'receiver_id' => $user->id,
                        'receiver_name' => $user->name,
                        'is_del' => '0',
                    ];                 

                }
            }
            Message::insert($data);
        }
        else if($request->post('chk_all') == '0'){
            Message::updateOrCreate(
                ['id' => $id],
                [
                    'subject' => $request->post('subject'),
                    'content' => $request->post('content'),
                    'send_date' => Carbon::now(),
                    'is_read' => '0',
                    'sender_id' => Auth::id(),
                    'sender_name' => Auth::user()->name,
                    'receiver_id' => $request->post('receiver_id'),
                    'receiver_name' => User::find($request->post('receiver_id'))->name,
                    'is_del' => '0',
                ]
            );
        }
        // $data = '<script>alert("답변이 성과적으로 등록되었습니다.");window.opener.location.reload();window.close();</script>';
        // return view('test', compact('data'));
        return response()->json(["status" => "success", "data" => '쪽지가 성과적으로 발송되었습니다.']);
    }
    //문의내용 삭제
    public function delete($id, Request $request)
    {
        $message = Message::destroy($id);
        return response()->json(["status" => "success", "data" => '쪽지가 성과적으로 삭제되었습니다.']);
    }
}
