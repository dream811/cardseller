<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'email', 'password', 'str_id', 'level', 'levelup_flag', 'type', 'is_use', 'is_del', 'phone', 'bank_id', 'bank_user', 'bank_account', 'money', 'buy_sum', 'deposit_sum', 'withdraw_sum', 'profit_sum', 'member_code', 'referer', 'rate', 'add_feature'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return ($this->type == 'ADMIN') ? true : false; // this looks for an admin column in your users table
    }
    public function isPartner()
    {
        return ($this->type == 'PARTNER') ? true : false; // this looks for an admin column in your users table
    }
    public function isUser()
    {
        return ($this->type == 'USER') ? true : false; // this looks for an admin column in your users table
    }
    public function userLevel()
    {
        return $this->belongsTo(UserLevel::class, 'level', 'level');
    }

    
}
