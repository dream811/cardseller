<?php

namespace App\Http\Controllers\Admin\Card;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\State;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
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
        $title = "State";


        if ($request->ajax()) {
            $data = State::where('is_del', 0)
                ->orderBy('name', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->editColumn('country_id', function ($row){
                    return $row->country->name;
                })
                ->addColumn('action', function ($row) {
                    $element = '<button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-warning btnEdit">Edit</button>';
                    $element .= '<button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-danger btnDelete">Delete</button>';
                    return $element;
                })
                ->rawColumns(['country_id','action'])
                ->make(true);
        }
        return view('admin.card.state_list', compact('title'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $countries = Country::where('is_del', 0)->get();
        $state = State::firstOrNew(['id' => $id]);

        return view('admin.card.state_detail', compact('countries', 'state', 'id'));
    }
    //
    public function save($id, Request $request)
    {
        State::updateOrCreate(
            ['id' => $id],
            [
                'name' => $request->post('name'),
                'country_id' => $request->post('country_id'),
            ]
        );
        $data = '<script>alert("Successfully saved.");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
    }
    //
    public function delete($id, Request $request)
    {
        State::find($id)->update(['is_del' => 1]);
        return response()->json(["status" => "success", "data" => 'Successfully deleted']);
    }
}
