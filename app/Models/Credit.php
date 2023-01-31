<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    protected $table = 'credit_list';
    // public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'coin_type',
        'coin_price',
        'coin_fee',
        'wallet_address',
        'amount',
        'status',
        'is_del',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
