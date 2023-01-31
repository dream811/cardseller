<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    use HasFactory;
    protected $table = 'user_level';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'level',
        'name',
        'pay_percent',
        'levelup_amount',
        'min_limit',
        'max_limit',
        'can_buy',
        'image',
        'is_use',
        'is_del',
    ];

}
