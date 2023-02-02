<?php

namespace App\Http\Controllers\Admin\Card;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use App\Models\Country;
use App\Models\State;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CardController extends Controller
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
        $countries = Country::where('is_use', 1)->where('is_del', 0)->get();
        $states = State::where('is_use', 1)->where('is_del', 0)->get();
        $cities = Card::where('is_del', 0)->where('is_purchased', 0)->groupBy('city')->select('city')->get();
        $categories = Card::where('is_del', 0)->where('is_purchased', 0)->groupBy('category')->select('category')->get();
        
        if ($request->ajax()) {
            $cards = Card::where('is_del', 0)
            ->where('is_purchased', 0)
            ->where('exp_date','>', \DB::raw('NOW()'))
            ->orderBy('created_at', 'DESC');

            return DataTables::of($cards)
                ->addIndexColumn()
                ->editColumn('type', function ($row) {
                    $type = '<img alt="gallery thumbnail" style="width:45px; height:26px;" src="'.asset('user_assets/images/cards/'.$row->type).'.png">';
                    return $type;
                })
                ->editColumn('country_id', function ($row) {
                    $country = $row->country->name;
                    return $country;
                })
                ->editColumn('state_id', function ($row) {
                    $state = $row->state->name;
                    return $state;
                })
                ->addColumn('bin', function ($row) {
                    $bin = substr($row->card_number, 0, 6);
                    return $bin;
                })
                ->addColumn('action', function ($row) {
                    
                    $btn = '';
                    if($row->is_purchased == 0){
                        $btn .= '<button type="button" data-id="'.$row->id.'" class="btn btn-sm btn-warning btnEdit">Edit</button>';
                        $btn .= '<button type="button" data-id="'.$row->id.'" class="btn btn-sm btn-danger btnDelete">Delete</button>';    
                    }
                    
                    return $btn;
                })
                ->filter(function ($query) use ($request) {
                    $query->when($request->get('country_id') != "", function ($query2) use ($request) {
                        $query2->where('country_id', $request->get('country_id'));
                    })
                    ->when($request->get('state_id') != "", function ($query2) use ($request) {
                        $query2->where('state_id', $request->get('state_id'));
                    })
                    ->when($request->get('category') != "", function ($query2) use ($request) {
                        $query2->where('category', 'like', '%'.$request->get('category').'%');
                    })
                    ->when($request->get('bin') != "", function ($query2) use ($request) {
                        $query2->where('card_number', 'like',  $request->get('bin').'%');
                    })
                    ->when($request->get('state_id') != "", function ($query2) use ($request) {
                        $query2->where('state_id', $request->get('state_id'));
                    })
                    ->when($request->get('zip') != "", function ($query2) use ($request) {
                        $query2->where('zip', $request->get('zip'));
                    })
                    ->when($request->get('type') != "", function ($query2) use ($request) {
                        $query2->where('type', $request->get('type'));
                    });
                })
                ->rawColumns(['type', 'action'])
                ->make(true);
        }
        return view('admin.card.list', compact('title', 'categories', 'countries', 'states', 'cities'));
    }

    //(post)
    public function edit($id = 0)
    {
        $title = "Edit";
        if ($id == 0) {
            $title = "Add";
        }

        $card = Card::where('id', $id)
            ->firstOrNew();

        $countries = Country::where('is_use', 1)->where('is_del', 0)->get();
        $states = State::where('is_use', 1)->where('is_del', 0)->get();

        return view('admin.card.detail', compact('title', 'id', 'card', 'countries', 'states'));
    }
    public function save($id, Request $request)
    {
        
        $data = [
            'type' => $request->post('type'),
            'cvv' => $request->post('cvv'),
            'exp_date' => $request->post('exp_date'),
            'category' => $request->post('category'),
            'price' => $request->post('price'),
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'phone' => $request->post('phone'),
            'card_number' => $request->post('card_number'),
            'card_address' => $request->post('card_address'),
            'country_id' => $request->post('country_id'),
            'state_id' => $request->post('state_id'),
            'city' => $request->post('city'),
            'zip' => $request->post('zip'),
            'is_del' => 0
        ];
        
        $card = Card::updateOrCreate(
            ['id' => $id],
            $data
        );
        $data = '<script>alert("Successfully saved");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
        //$user->image = asset('storage/'. $user->image);
        //return response()->json(["status" => "success", "data" => $card]);
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

    //
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

    public function search_state($id){
        $states = State::where('country_id', $id)->get();
        return response()->json(["status" => "success", "data" => $states]);
    }

    public function search_city($id){
        $cities = Card::where('state_id', $id)->where('is_del', 0)->where('is_purchased', 0)->groupBy('city')->select('city')->get();
        return response()->json(["status" => "success", "data" => $cities]);
    }
}
