<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardSell extends Model
{
    use HasFactory;
    protected $table = 'card_sell_list';
    // public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'card_id',
        'cur_price',
        'info',
        'is_del',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }
}
