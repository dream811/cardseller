<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use App\Models\CardSell;
use App\Models\Country;
use App\Models\State;
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
        $title="Buy Cards";
        $countries = Country::where('is_use', 1)->where('is_del', 0)->get();
        $states = State::where('is_use', 1)->where('is_del', 0)->get();
        $cities = Card::where('is_del', 0)->where('is_purchased', 0)->groupBy('city')->select('city')->get();
        $categories = Card::where('is_del', 0)->where('is_purchased', 0)->groupBy('category')->select('category')->get();
        // $bins = Card::where('is_del', 0)->where('is_purchased', 0)->groupBy('card_number')->select(\DB::raw('SUBSTRING(card_number, 1, 4) as bin'))->get();

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
                    $btn = '<button type="button" data-id="'.$row->id.'" class="btn btn-success btnEdit">Buy($'.number_format($row->price, 1).')</button>';
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
        return view('user.card.list', compact('title', 'categories', 'countries', 'states', 'cities'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save($id, Request $request){
        $card = Card::find($id);
        $user = User::find(Auth::id());
        if($user->money < $card->price){
            return response()->json(["status" => "success", "data" => 'You need to purchase credit card.']);
        }
        $user->money = $user->money - $card->price;
        $user->save();
        $yrdata= strtotime($row->exp_date);
        $exp_date = date('n/Y', $yrdata);
        $info = $card->card_number. '|' . 
            $exp_date. '|'. 
            $card->cvv. '|' . 
            $card->card_name. '|' . 
            $card->card_address .'|' . 
            $card->city .'|'. 
            $card->state->name .'|' . 
            $card->zip .'|' . 
            $card->phone .'|' . 
            $card->email .'|' . 
            $card->country->name;
        CardSell::create(
            [
                'user_id' => Auth::id(),
                'card_id' => $id,
                'cur_price' => $card->price,
                'info' => $info
            ]);

        $card->is_purchased = 1;
        $card->save();
        return response()->json(["status" => "success", "data" => 'You have successfully purchased this card.']);
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
