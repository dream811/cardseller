<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CardSell;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class MyCardController extends Controller
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
        $title="My Cards";
        if ($request->ajax()) {
            $cards = CardSell::where('is_del', 0)->where('user_id', Auth::id())->orderBy('created_at', 'DESC');

            return DataTables::of($cards)
                ->addIndexColumn()                
                ->addColumn('info', function ($row) {
                    $card = $row->card;
                    $yrdata= strtotime($card->exp_date);
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
                    return $info;
                })
                ->addColumn('action', function ($row) {
                    $diff = strtotime('now') - strtotime($row->card->exp_date);
                    $badge = "badge-success"; $status = "Live"; 
                    if($diff) {$badge = "badge-danger"; $status = "Expired";}
                    $btn = '<span style="width:50px;" class="badge '.$badge.'">'.$status.'</span>';
                    return $btn;
                })
                ->editColumn('created_at', function($row){ 
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d-m-Y'); 
                    return $formatedDate; 
                })
                ->rawColumns(['info', 'action'])
                ->make(true);
        }
        return view('user.my_card.list', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save($id, Request $request){
        return;
       
        // $card = Card::find($id);
        // $user = User::find(Auth::id());

        // if($card->is_purchased == 1){
        //     return response()->json(["status" => "error", "data" => 'Someone has already purchased this card.']);
        // }else if($card->price > $user->money){
        //     return response()->json(["status" => "error", "data" => 'You must buy more credit to get this card.']);
        // }

        
        // $user->money = $user->money - $card->price;
        // $user->buy_sum = $user->buy_sum + $card->price;
        // $user->save();
        // CardSell::create(
        //     [
        //         'user_id' => Auth::id(),
        //         'card_id' => $id,
        //         'cur_price' => $card->price,
        //     ]);

        // $card->is_purchased = 1;
        // $card->save();
        // return response()->json(["status" => "success", "data" => 'You have successfully purchased this card.']);
    }
}
