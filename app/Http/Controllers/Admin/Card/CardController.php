<?php

namespace App\Http\Controllers\Admin\Coin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coin;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CoinController extends Controller
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

        $title = "Card Management";

        if ($request->ajax()) {
            $coins = Coin::orderBy('name');

            return DataTables::of($coins)
                ->addIndexColumn()
                ->editColumn('is_use', function ($row) {
                    $checked = $row->is_use ? "checked" : "";
                    $btn='<div>
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input chk-is-use" '.$checked.' data-id="'.$row->id.'" id="chkUse_'.$row->id.'">
                        <label class="custom-control-label" for="chkUse_'.$row->id.'"></label>
                        </div>
                    </div>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    return '<img style="vertical-align: baseline;" src="'.asset('user_assets/images/coins'.'/'.$row->image).'" class="img-fluid avatar avatar-10 avatar-rounded" alt="">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">Edit</button>';
                    // $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                    return $btn;
                })
                ->rawColumns(['action', 'image', 'is_use'])
                ->make(true);
        }
        return view('admin.coin.list', compact('title'));
    }

    //(post)
    public function edit($cardId = 0)
    {
        $title = "Edit";
        if ($cardId == 0) {
            $title = "Add";
        }

        $card = Card::where('id', $cardId)
            ->firstOrNew();

        return view('admin.card.detail', compact('title', 'cardId', 'card'));
    }
    public function save(Request $request)
    {
        // $path = $request->post('beforeImage');

        // if ($request->file('fileImage')) {
        //     if ($path != "") {
        //         Storage::delete('public/' . $path);
        //     }

        //     $imageFile = $request->file('fileImage');
        //     $new_name = rand() . '.' . $imageFile->getClientOriginalExtension();
        //     $old_name = $imageFile->getClientOriginalName();
        //     $path = url('storage') . '/' . $request->file('fileImage')->storeAs('/uploads/profile_images', $new_name, 'public');
        // }
        $data = [
            // 'mb_profile' => $path,
            'is_use' => $request->post('is_use'),
            'key' => $request->post('key'),
            'name' => $request->post('key'),
            'kor_name' => $request->post('kor_name'),
            'sell_limit' => $request->post('sell_limit'),
        ];
        
        $coin = Coin::updateOrCreate(
            ['id' => $request->post('id')],
            $data
        );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $coin]);
    }

    public function checkIDEmail(Request $request)
    {
        $email = 1;
        $id = 1;
        if ($request->get('userId') == 0) {
            if (User::where('strID', $request->get('txtID'))->count()) {
                $id = 0;
            }
            if (User::where('email', $request->get('txtEmail'))->count()) {
                $email = 0;
            }
        } else {
            $user = User::where('id', '!=', $request->get('userId'));
            if ($user->where('strID', $request->get('txtID'))->count()) {
                $id = 0;
            }
            if ($user->where('email', $request->get('txtEmail'))->count()) {
                $email = 0;
            }
        }
        return response()->json(["status" => "success", "data" => compact('id', 'email')]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        //$coupang->getCategoryInfoViaCode(56174);
        $coupang->getCategoryMetaInfo(0);
        // $coupang->getCategoryListInfo();
        // $coupang->addOutboundShippingCenter();
        // $coupang->addReturnShippingCenter();
        $coupang->addProduct();
        return view('product.MarketIDList');
    }

    //사용상태 변경
    public function state($coinId, Request $request)
    {
        $status = $request->post('status');

        
       
        $coin = Coin::where('id', $coinId)
            ->update(            
                ['is_use' => $status]
            );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $coin]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $accountId
     * @return \Illuminate\Http\Response
     */
    public function accountDelete($marketId, $accountId)
    {
        //
        //$marketAccount = MarketAccount::where('nIdx', $accountId)->delete();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }
}
