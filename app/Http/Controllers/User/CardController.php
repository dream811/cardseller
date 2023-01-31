<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use App\Models\CardSell;
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
        if ($request->ajax()) {
            $cards = Card::where('is_del', 0)->where('is_purchased', 0)->orderBy('created_at', 'DESC');

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
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="'.$row->id.'" class="btn btn-success btnEdit">Buy($'.number_format($row->price, 1).')</button>';
                    return $btn;
                })
                ->rawColumns(['type', 'action'])
                ->make(true);
        }
        return view('user.card.list', compact('title'));
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

        CardSell::create(
            [
                'user_id' => Auth::id(),
                'card_id' => $id,
                'cur_price' => $card->price,
            ]);

        $card->is_purchased = 1;
        $card->save();
        return response()->json(["status" => "success", "data" => 'You have successfully purchased this card.']);
    }
}
