<?php

namespace App\Http\Controllers\Admin\Card;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
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
        $title = "Country";


        if ($request->ajax()) {
            $data = Country::where('is_del', 0)
                ->orderBy('name', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()                
                ->addColumn('action', function ($row) {
                    $element = '<button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-warning btnEdit">Edit</button>';
                    $element .= '<button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-danger btnDelete">Delete</button>';
                    return $element;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.card.country_list', compact('title'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $country = Country::firstOrNew(['id' => $id]);

        return view('admin.card.country_detail', compact('country', 'id'));
    }
    //
    public function save($id, Request $request)
    {
        Country::updateOrCreate(
            ['id' => $id],
            [
                'name' => $request->post('name'),
            ]
        );
        $data = '<script>alert("Successfully saved.");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
    }
    //
    public function delete($id, Request $request)
    {
        Country::find($id)->update(['is_del' => 1]);
        return response()->json(["status" => "success", "data" => 'Successfully deleted']);
    }
}
