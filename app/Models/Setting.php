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
        'apirone_account',
        'apirone_trans_key',
        'guide',
        'service_pause_msg',
    ];

}
