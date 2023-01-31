<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'app_name',
        'account_id',
        'account_password',
        'guide',
        'service_pause_msg',
    ];

}
